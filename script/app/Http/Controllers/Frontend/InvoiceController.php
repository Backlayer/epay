<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\HasPayment;
use App\Helpers\HasUploader;

use App\Http\Controllers\Controller;
use App\Models\Gateway;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    use HasPayment;
    use HasUploader;

    private function getTotalAmount(Invoice $invoice)
    {
        $invoice->loadSum('items', 'subtotal');
        $subTotal = $invoice->items_sum_subtotal;
        $discount = ($subTotal * $invoice->discount) / 100;
        $afterDiscountAmount = $subTotal - $discount;
        $tax = ($afterDiscountAmount * $invoice->tax) / 100;

        return $afterDiscountAmount + $tax;
    }

    public function index(Invoice $invoice)
    {
        $this->clearSessions();

        $gateways = Gateway::where('is_auto', 1)->whereStatus(1)
            ->when(!Auth::check(), function ($builder) {
                $builder->whereNotIn("namespace", ["App\\Lib\\Credit"]);
            })
            ->orderBy('name')
            ->get();

        $amount = $this->getTotalAmount($invoice);

        return view('frontend.invoice.index', compact('invoice', 'gateways', 'amount'));
    }

    public function gateway(Request $request, Invoice $invoice)
    {
        abort_if($invoice->is_paid, 404);

        $request->validate([
            'gateway' => ['required', 'exists:gateways,id'],
            'amount' => [Rule::requiredIf(fn () => !$invoice->amount), 'numeric']
        ]);

        $amount = $this->getTotalAmount($invoice);

        $gateway = Gateway::where('is_auto', 1)->findOrFail($request->input('gateway'));

        return view('frontend.invoice.gateway', compact('invoice', 'gateway', 'amount'));
    }

    public function payment(Request $request, Invoice $invoice, Gateway $gateway)
    {
        $this->validateRequest($request, $gateway);

        //Store Data For Save to DB
        Session::put('invoicePaymentData', [
            'invoice' => $invoice,
            'gateway' => $gateway
        ]);

        if (Auth::check()) {
            $info = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ];
        } else {
            $info = [
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ];
        }

        $amount = $this->getTotalAmount($invoice);

        Session::put('amount', $amount);

        $convertedAmount = convert_money_direct($amount, $invoice->currency, $gateway->currency);

        $dataFields = [];

        foreach ($gateway->fields ?? [] as $index => $item) {
            if ($item['type'] == 'file') {
                /*$request->validate([
                    'fields.' . $item['label'] => ['required', 'mimes:jpg,jpeg,png.pdf', 'max:2048'], // 2MB
                ]);*/
            }
        }

        foreach ($request->fields as $key => $value) {
            $field = $request->fields[$key];

            if (is_file($field)) {
                $dataFields[$key] = $this->upload($request, 'fields.' . $key);
            } else {
                $dataFields[$key] = $field;
            }
        }

        $data = [
            'currency' => $gateway->currency->code,
            'name' => $info['name'],
            'email' => $info['email'],
            'phone' => $request->input('phone'),
            'billName' => __("Invoice Payment"),
            'amount' => $convertedAmount,
            'test_mode' => $gateway->test_mode,
            'charge' => $gateway->charge,
            'pay_amount' => round($convertedAmount + $gateway->charge, 2, PHP_ROUND_HALF_ODD),
            'gateway_id' => $gateway->id,
            'payment_type' => 'invoice',
            'request_from' => 'merchant',
            'data' => $dataFields,
            'fields' => $gateway->fields
        ];

        Session::put('userInfo', $info);
        Session::put('without_tax', true);
        Session::put('fund_callback.success_url', '/payment/success');
        Session::put('fund_callback.cancel_url', '/payment/failed');

        if (!Auth::check()) {
            Session::put('without_auth', true);
        } else {
            Session::put('without_auth', false);
        }

        return $this->proceedToPayment($request, $gateway, $data);
    }
}
