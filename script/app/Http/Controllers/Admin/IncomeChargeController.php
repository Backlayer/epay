<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IncomeChargeController extends Controller
{
    public function index()
    {
        $types = [
            'fixed' => __('Fixed'),
            'percentage' => __('Percentage')
        ];

        $charges = get_option('charges');

        return view('admin.settings.charges', compact('types', 'charges'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'request_money_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'request_money_charge_rate' => ['required', 'numeric'],
            'withdraw_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'withdraw_charge_rate' => ['required', 'numeric'],
            'transfer_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'transfer_charge_rate' => ['required', 'numeric'],
            'transaction_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'transaction_charge_rate' => ['required', 'numeric'],
            'single_payment_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'single_payment_charge_rate' => ['required', 'numeric'],
            'donation_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'donation_charge_rate' => ['required', 'numeric'],
            'invoice_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'invoice_charge_rate' => ['required', 'numeric'],
            'user_plan_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'user_plan_charge_rate' => ['required', 'numeric'],
            'merchant_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'merchant_charge_rate' => ['required', 'numeric'],
            'qr_payment_charge_type' => ['required', Rule::in(['fixed', 'percentage'])],
            'qr_payment_charge_rate' => ['required', 'numeric'],
        ]);

        Option::updateOrCreate([
            'key' => 'charges',
            'lang' => 'en'
        ], [
            'value' => [
                "request_money_charge" => [
                    "type" => $validated['request_money_charge_type'],
                    "rate" => $validated['request_money_charge_rate']
                ],
                "withdraw_charge" => [
                    "type" => $validated['withdraw_charge_type'],
                    "rate" => $validated['withdraw_charge_rate']
                ],
                "transfer_charge" => [
                    "type" => $validated['transfer_charge_type'],
                    "rate" => $validated['transfer_charge_rate']
                ],
                "transaction_charge" => [
                    "type" => $validated['transaction_charge_type'],
                    "rate" => $validated['transaction_charge_rate']
                ],
                "single_payment_charge" => [
                    "type" => $validated['single_payment_charge_type'],
                    "rate" => $validated['single_payment_charge_rate']
                ],
                "donation_charge" => [
                    "type" => $validated['donation_charge_type'],
                    "rate" => $validated['donation_charge_rate']
                ],
                "invoice_charge" => [
                    "type" => $validated['invoice_charge_type'],
                    "rate" => $validated['invoice_charge_rate']
                ],
                "user_plan_charge" => [
                    "type" => $validated['user_plan_charge_type'],
                    "rate" => $validated['user_plan_charge_rate']
                ],
                "merchant_charge" => [
                    "type" => $validated['merchant_charge_type'],
                    "rate" => $validated['merchant_charge_rate']
                ],
                "qr_payment_charge" => [
                    "type" => $validated['qr_payment_charge_type'],
                    "rate" => $validated['qr_payment_charge_rate']
                ]
            ]
        ]);

        return response()->json([
            'message' => __("Income Charges Updated Successfully"),
            'redirect' => route('admin.settings.charges.index')
        ]);
    }
}
