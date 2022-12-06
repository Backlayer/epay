<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\UserBank;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ConfigureBankAccountController extends Controller
{
    public function index()
    {
        abort_if(\Auth::user()->banks()->exists(), 404);
        $banks = Bank::whereCurrencyId(\Auth::user()->currency_id)->pluck('name', 'id');
        return view('user.configure-banks.set-bank.index', compact('banks'));
    }

    public function store(Request $request)
    {
        abort_if(\Auth::user()->banks()->exists(), 404);
        $request->validate([
            'bank' => ['required', 'exists:banks,id'],
            'account_type' => ['required', Rule::in(['individual', 'company'])],
            'account_number' => ['required', 'numeric'],
            'account_name' => ['required', 'string'],
            'routing_number' => ['required', 'numeric']
        ]);

        UserBank::create([
            'user_id' => \Auth::id(),
            'bank_id' => $request->input('bank'),
            'data' => [
                'account_number' => $request->input('account_number'),
                'account_name' => $request->input('account_name'),
                'account_type' => $request->input('account_type'),
                'routing_number' => $request->input('routing_number'),
            ]
        ]);

        return response()->json([
            'message' => __("Bank Account Successfully Added"),
            'redirect' => route('user.dashboard.index')
        ]);
    }
}
