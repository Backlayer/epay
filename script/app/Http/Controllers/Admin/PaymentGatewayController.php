<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use App\Models\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class PaymentGatewayController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:gateways-create')->only('create', 'store');
        $this->middleware('permission:gateways-read')->only('index', 'show');
        $this->middleware('permission:gateways-update')->only('edit', 'update');
        $this->middleware('permission:gateways-delete')->only('destroy');
    }

    public function index()
    {
        $gateways = Gateway::with('currency')->get();
        return view('admin.gateway.index', compact('gateways'));
    }

    public function create()
    {
        $currencies = Currency::whereStatus(1)->get();

        return view('admin.gateway.create', compact('currencies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:gateways,name',
            'logo' => 'nullable|image|max:100',
            'charge' => 'required',
            'currency' => 'required|exists:currencies,id',
            'min_amount' => ['required', 'numeric', 'min:0'],
            'max_amount' => ['required', 'numeric', 'min:0', 'gte:min_amount'],
        ]);

        $gateway = new Gateway();

        if ($request->hasFile('logo')) {

            $image = $request->file('logo');
            $path = 'uploads/' . strtolower(env('APP_NAME')) . date('/y/m/');
            $name = uniqid() . date('dmy') . time() . "." . strtolower($image->getClientOriginalExtension());
            Storage::disk(env('STORAGE_TYPE'))->put($path . $name, file_get_contents(Request()->file('logo')));
            $file_url = Storage::disk(env('STORAGE_TYPE'))->url($path . $name);
            $gateway->logo = $file_url;
        }

        $gateway->currency_id = $request->currency;
        $gateway->name = $request->name;
        $gateway->charge = $request->charge;
        $gateway->namespace = 'App\Lib\CustomGateway';
        $gateway->is_auto = 0;
        $gateway->image_accept = $request->image_accept;
        $gateway->status = $request->status;
        $gateway->data = $request->instruction;
        $gateway->save();

        return response()->json('Successfully Created!');
    }

    public function edit($id)
    {
        $gateway = Gateway::findOrFail($id);
        $currencies = Currency::whereStatus(1)->get();
        return view('admin.gateway.edit', compact('gateway', 'currencies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:gateways,name,' . $id,
            'logo' => 'nullable|image|max:100',
            'charge' => 'required',
            'namespace' => 'nullable',
            'currency' => 'required|exists:currencies,id',
            'min_amount' => ['required', 'numeric', 'min:0'],
            'max_amount' => ['required', 'numeric', 'min:0', 'gte:min_amount'],
        ]);

        $gateway = Gateway::findOrFail($id);

        if ($gateway->is_auto == 0) {
            $request->validate([
                'payment_instruction' => 'required',
            ]);
            $gateway->data = $request->payment_instruction;
        } else {
            $gateway->data = $request->data ? json_encode($request->data) : '';
        }
        if ($request->hasFile('logo')) {
            if (!empty($gateway->logo)) {
                $file = $gateway->logo;
                $arr = explode('uploads', $file);
                if (count($arr ?? []) != 0) {
                    if (isset($arr[1])) {
                        Storage::disk(env('STORAGE_TYPE'))->delete('uploads' . $arr[1]);
                    }
                }
            }

            $image = $request->file('logo');
            $path = 'uploads/' . strtolower(env('APP_NAME')) . date('/y/m/');
            $name = uniqid() . date('dmy') . time() . "." . strtolower($image->getClientOriginalExtension());

            Storage::disk(env('STORAGE_TYPE'))->put($path . $name, file_get_contents(Request()->file('logo')));

            $file_url = Storage::disk(env('STORAGE_TYPE'))->url($path . $name);
            $gateway->logo = $file_url;
        }

        $gateway->name = $request->name;
        $gateway->charge = $request->charge;
        $gateway->currency_id = $request->currency;
        $gateway->test_mode = $request->test_mode;
        $gateway->status = $request->status;
        $gateway->image_accept = $request->image_accept;
        $gateway->min_amount = $request->min_amount;
        $gateway->max_amount = $request->max_amount;      
        $gateway->save();

        return response()->json('Successfully Updated!');
    }
}
