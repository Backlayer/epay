<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Currency;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:banks-create')->only('create', 'store');
        $this->middleware('permission:banks-read')->only('index', 'show');
        $this->middleware('permission:banks-update')->only('edit', 'update');
        $this->middleware('permission:banks-delete')->only('edit', 'destroy');
    }
    public function index()
    {
        $currencies = Currency::latest()->get();
        $banks = Bank::latest()->with('currency')->paginate(10);
        return view('admin.banks.index', compact('currencies', 'banks'));
    }

    public function create()
    {
        $countries = Currency::whereStatus(1)
            ->groupBy('country_name')
            ->orderBy('country_name')
            ->pluck('country_name', 'id');
        return view('admin.banks.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|max:100',
            'name' => 'required|string|max:100',
            'currency_id' => 'required|integer',
        ]);
        Bank::create($request->all());
        return response()->json(__('Bank created successfully.'));
    }

    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'code' => 'required|max:100',
            'name' => 'required|string|max:100',
            'currency_id' => 'required|integer',
        ]);

        $bank->update($request->all());
        return response()->json(__('Bank updated successfully.'));
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();
        return response()->json([
            'message' => __('Banks Deleted Successfully'),
            'redirect' => route('admin.banks.index')
        ]);
    }
}
