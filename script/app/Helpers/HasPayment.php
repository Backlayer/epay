<?php

namespace App\Helpers;

use App\Models\Gateway;
use App\Rules\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Session;

trait HasPayment
{
    private function validateRequest(Request $request, Gateway $gateway): void
    {
        $request->validate([
            'name' => [Rule::requiredIf(fn() => !\Auth::check()), 'string'],
            'email' => [Rule::requiredIf(fn() => !\Auth::check()), 'email'],
            'phone' => [
                Rule::requiredIf(fn() => $gateway->phone_required),
                new Phone
            ],
            'comment' => ['nullable', 'string', 'max:255'],
            'screenshot' => ['nullable', 'image', 'max:2048'] // 2MB
        ]);
    }

    private function proceedToPayment(Request $request, Gateway $gateway, array $paymentData)
    {
        // Upload files if exists
        if ($gateway->is_auto == 0) {
            $paymentData['comment'] = $request->input('comment');
            if ($request->hasFile('screenshot')) {

                $path = 'uploads/' . strtolower(config('app.name')) . '/payments' . date('/y/m/');
                $name = uniqid() . date('dmy') . time() . "." . $request->file('screenshot')->getClientOriginalExtension();

                Storage::disk(config('filesystems.default'))->put($path . $name, file_get_contents(Request()->file('screenshot')));

                $image = Storage::disk(config('filesystems.default'))->url($path . $name);

                $paymentData['screenshot'] = $image;
            }
        }

        $gatewayInfo = json_decode($gateway->data, true);
        if (!empty($gatewayInfo)){
            foreach ($gatewayInfo as $key => $value) {
                $paymentData[$key] = $value;
            }
        }

        return $gateway->namespace::make_payment($paymentData);
    }

    private function clearSessions()
    {
        Session::forget('payment_info');
        Session::forget('singlePaymentData');
        Session::forget('payment_info');
        Session::forget('singlePaymentData');
        Session::forget('donationPaymentData');
        Session::forget('invoicePaymentData');
        Session::forget('planPaymentData');
        Session::forget('merchantPaymentData');
        Session::forget('qrPaymentData');
        Session::forget('charge_wallet');
        Session::forget('amount');
    }
}
