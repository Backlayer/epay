<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:currencies-create')->only('create', 'store');
        $this->middleware('permission:currencies-read')->only('index', 'show');
        $this->middleware('permission:currencies-update')->only('edit', 'update', 'makeDefault', 'sync');
        $this->middleware('permission:currencies-delete')->only('edit', 'destroy');
    }
    public function index()
    {
        $currencies = Currency::all();

        return view('admin.currencies.index', compact('currencies'));
    }

    public function create()
    {
        $countries = json_decode(file_get_contents(lang_path('countrylist.json')), true);
        return view('admin.currencies.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:currencies,name'],
            'code' => ['required', 'string', 'unique:currencies,code'],
            'rate' => ['required', 'numeric'],
            'symbol' => ['required', 'string'],
            'position' => ['required', 'string'],
            'country_name' => ['required', 'string'],
            'status' => ['required', 'bool'],
        ]);

        Currency::create($validated);

        return response()->json([
            'message' => __('Currency Created Successfully'),
            'redirect' => route('admin.currencies.index')
        ]);
    }

    public function edit(Currency $currency)
    {
        $countries = json_decode(file_get_contents(lang_path('countrylist.json')), true);
        return view('admin.currencies.edit', compact('currency', 'countries'));
    }

    public function update(Request $request, Currency $currency)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', Rule::unique('currencies')->ignore($currency->id)],
            'code' => ['required', 'string',  Rule::unique('currencies')->ignore($currency->id)],
            'rate' => ['required', 'numeric'],
            'symbol' => ['required', 'string'],
            'position' => ['required', 'string'],
            'country_name' => ['required', 'string'],
            'status' => ['required', 'bool'],
        ]);

        $currency->update($validated);

        return response()->json([
            'message' => __('Currency Updated Successfully'),
            'redirect' => route('admin.currencies.index')
        ]);
    }

    public function destroy(Currency $currency)
    {
        if($currency->is_default){
            return response()->json(__('Default currency is not deletable'), 422);
        }

        if ($currency->gateways){
            return response()->json(__('You are not allowed to delete :type because it has :number :child .', ['type' => $currency->name, 'number' => $currency->gateways->count(), 'child' => $currency->gateways->count() == 1 ? 'Gateway': 'Gateways']), 422);
        }

        $currency->delete();

        return response()->json([
            'message' => __('Currency Deleted Successfully'),
            'redirect' => route('admin.currencies.index')
        ]);
    }

    public function makeDefault(Currency $currency)
    {
        if($currency->is_default){
            return response()->json(__('Currency is already default'), 422);
        }

        Currency::query()->update(['is_default' => 0, 'rate' => 1]);

        $currency->update(['is_default' => 1]);

        $this->sync();

        return response()->json([
            'message' => __(':name Set As Default Currency', ['name' => $currency->name]),
            'redirect' => route('admin.currencies.index')
        ]);
    }

    public function sync()
    {
        $defaultCurrency = Currency::whereIsDefault(1)->first() ?? default_currency();
        $allCurrencies = Currency::whereIsDefault(0)->pluck('code');

        if ($allCurrencies->count() > 0 ){
            $allCurrencies = $allCurrencies->map(fn($currency) => $currency)->implode(',');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/latest?symbols=".$allCurrencies."&base=".$defaultCurrency->code,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: text/plain",
                    "apikey: ".env('APILAYER_API_KEY')
                ),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET"
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($response, true);

            if (isset($response['success'])){
                foreach ($response['rates'] as $code => $rate) {
                    Currency::whereCode($code)->first()->update([
                        'rate' => round($rate, 2)
                    ]);
                }

                \Cache::forever('currency_last_sync_at', now());

                return response()->json([
                    'message' => __('Currency Synced Successfully'),
                    'redirect' => route('admin.currencies.index')
                ]);
            }

            return response()->json(['message' => __('Currency Sync Failed')], 422);
        }
    }
}
