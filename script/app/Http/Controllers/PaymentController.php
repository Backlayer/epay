<?php

namespace App\Http\Controllers;

use App\Helpers\HasPayment;
use App\Mail\AuthorDonationOrderMail;
use App\Mail\AuthorInvoicePaymentMail;
use App\Mail\AuthorSingleChargeOrderMail;
use App\Mail\DonationOrderMail;
use App\Mail\InvoicePaymentMail;
use App\Mail\MerchantPaymentMail;
use App\Mail\SingleChargeOrderMail;
use App\Models\Donation;
use App\Models\DonationOrder;
use App\Models\Gateway;
use App\Models\Qrpayment;
use App\Models\SingleChargeOrder;
use App\Models\Transaction;
use App\Models\WebOrder;
use App\Models\Website;
use App\Models\WebTestOrder;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use Mail;
use Throwable;

class PaymentController extends Controller
{
    use HasPayment;

    /**
     * @throws Throwable
     */
    public function success()
    {
        $paymentInfo = Session::get('payment_info');
        abort_if(!$paymentInfo, 404);
        if ($paymentInfo['payment_type'] == 'single_charge') {
            return $this->singleChargePayment($paymentInfo);
        } elseif ($paymentInfo['payment_type'] == 'donation') {
            return $this->donationPayment($paymentInfo);
        } elseif ($paymentInfo['payment_type'] == 'invoice') {
            return $this->invoicePayment($paymentInfo);
        } elseif ($paymentInfo['payment_type'] == 'merchant') {
            return $this->merchantPayment($paymentInfo);
        } elseif ($paymentInfo['payment_type'] == 'qr_payment') {
            return $this->qrPayment($paymentInfo);
        }
    }

    public function failed()
    {
        return view('payment.failed');
    }

    public function singleChargePayment($paymentInfo)
    {
        DB::beginTransaction();

        try {
            $singlePaymentData = Session::get('singlePaymentData');
            $singleCharge = $singlePaymentData['singleCharge'];
            $gateway = $singlePaymentData['gateway'];
            $originalAmount = Session::get('amount');
            $userInfo = Session::get('userInfo');

            // Calculate Income, taxes etc
            $convertToDefaultAmount = convert_money($originalAmount, $singleCharge->currency);
            $getTax = calculate_taxes($convertToDefaultAmount, false);
            $getExtraCharge = calculate_extra_charge($convertToDefaultAmount, 'single_payment_charge');
            $totalCharge = $getTax + $getExtraCharge;

            $convertToOwnerAmount = convert_money($convertToDefaultAmount, $singleCharge->user->currency, true);
            $convertToOwnerCharge = convert_money($totalCharge, $singleCharge->user->currency, true);

            $singleChargeOrder = SingleChargeOrder::create([
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                "trx" => $paymentInfo['payment_id'],
                "amount" => $convertToOwnerAmount - $convertToOwnerCharge,
                "rate" => $singleCharge->user->currency->rate,
                "charge" => $convertToOwnerCharge,
                "status" => true,
                "user_id" => $singleCharge->user_id,
                "gateway_id" => $gateway->id,
                "singlecharge_id" => $singleCharge->id,
                "currency_id" => $singleCharge->user->currency_id
            ]);

            // Add Income to Author Profile
            $wallet = $singleCharge->user->wallet;
            $singleCharge->user->update([
                'wallet' => $wallet + ($convertToOwnerAmount - $convertToOwnerCharge)
            ]);

            //Generate Transaction for buyers
            if (Auth::check()) {
                $convertToBuyerAmount = convert_money($convertToDefaultAmount, user_currency(), true);

                Transaction::create([
                    'name' => $userInfo['name'],
                    'email' => $userInfo['email'],
                    'user_id' => Auth::id(),
                    'currency_id' => user_currency()->id,
                    'amount' => -$convertToBuyerAmount,
                    'charge' => null,
                    'rate' => user_currency()->rate,
                    'reason' => __('Payment sent to :name', ['name' => $singleCharge->user->business_name ?? $singleCharge->user->name]),
                    'type' => 'debit'
                ]);
            }

            //Generate Transaction for sellers
            Transaction::create([
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'user_id' => $singleCharge->user_id,
                'currency_id' => $singleCharge->user->currency_id,
                'amount' => $convertToOwnerAmount - $convertToOwnerCharge,
                'charge' => $convertToOwnerCharge,
                'rate' => $singleCharge->user->currency->rate,
                'reason' => __('Payment received from :name', ['name' => $userInfo['name']]),
                'type' => 'credit'
            ]);

            DB::commit();

            // Send Email to Author and Customer
            if (config('system.queue.mail')) {
                Mail::to($userInfo['email'])->queue(new SingleChargeOrderMail($singleChargeOrder, $userInfo));
                Mail::to($singleCharge->user)->queue(new AuthorSingleChargeOrderMail($singleChargeOrder, $userInfo));
            } else {
                Mail::to($userInfo['email'])->send(new SingleChargeOrderMail($singleChargeOrder, $userInfo));
                Mail::to($singleCharge->user)->send(new AuthorSingleChargeOrderMail($singleChargeOrder, $userInfo));
            }

            $this->clearSessions();

            if ($singleCharge->return_url) {
                return redirect($singleCharge->return_url);
            } elseif (Auth::check()) {
                return to_route('user.transactions.index', 'single-charge')->with('success', __('Payment Successfully Completed'));
            } else {
                return to_route('frontend.single-charge.index', $singleCharge->uuid)->with('success', __('Thanks! We received your payment'));
            }
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->clearSessions();

            throw $exception;
        }
    }

    public function donationPayment($paymentInfo)
    {
        DB::beginTransaction();

        try {
            $donationData = Session::get('donationPaymentData');
            $donation = $donationData['donation'];
            $gateway = $donationData['gateway'];
            $originalAmount = Session::get('amount');
            $userInfo = Session::get('userInfo');

            // Calculate Income, taxes etc
            $convertToDefaultAmount = convert_money($originalAmount, $donation->currency);
            $getTax = calculate_taxes($convertToDefaultAmount, false);
            $getExtraCharge = calculate_extra_charge($convertToDefaultAmount, 'single_payment_charge');
            $totalCharge = $getTax + $getExtraCharge;

            $convertToOwnerAmount = convert_money(($convertToDefaultAmount), $donation->user->currency, true);
            $convertToOwnerCharge = convert_money($totalCharge, $donation->user->currency, true);

            // Add Income to Author Profile
            $wallet = $donation->user->wallet;
            $donation->user->update([
                'wallet' => $wallet + ($convertToOwnerAmount - $convertToOwnerCharge)
            ]);

            $donationOrder = DonationOrder::create([
                "trx" => $paymentInfo['payment_id'],
                "amount" => $convertToOwnerAmount - $convertToOwnerCharge,
                "charge" => $convertToOwnerCharge,
                "rate" => $donation->user->currency->rate,
                "is_anonymous" => $userInfo['donate_as'] == 'anonymous',
                "data" => null,
                "status" => $paymentInfo['payment_status'],
                "name" => $userInfo['name'],
                "email" => $userInfo['email'],
                "user_id" => $donation->user_id,
                "gateway_id" => $gateway->id,
                "currency_id" => $donation->user->currency_id,
                "donation_id" => $donation->id
            ]);

            //Generate Transaction for buyers
            if (Auth::check()) {
                $convertToBuyerAmount = convert_money($convertToDefaultAmount, user_currency(), true);

                Transaction::create([
                    'name' => $userInfo['name'],
                    'email' => $userInfo['email'],
                    'user_id' => Auth::id(),
                    'currency_id' => Auth::user()->currency_id,
                    'amount' => - ($convertToBuyerAmount),
                    'charge' => null,
                    'rate' => user_currency()->rate,
                    'reason' => __('Donation sent to :name', ['name' => $donation->user->business_name ?? $donation->user->name]),
                    'type' => 'debit'
                ]);
            }

            //Generate Transaction for sellers
            Transaction::create([
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'user_id' => $donation->user_id,
                'currency_id' => $donation->user->currency_id,
                'amount' => $convertToOwnerAmount - $convertToOwnerCharge,
                'charge' => $convertToOwnerCharge,
                'rate' => $donation->user->currency->rate,
                'reason' => __('Donation received from :name', ['name' => $userInfo['name']]),
                'type' => 'credit'
            ]);

            DB::commit();

            // Send Email to Author and Customer
            if (config('system.queue.mail')) {
                Mail::to($userInfo['email'])->queue(new DonationOrderMail($donationOrder, $userInfo));
                Mail::to($donation->user)->queue(new AuthorDonationOrderMail($donationOrder, $userInfo));
            } else {
                Mail::to($userInfo['email'])->send(new DonationOrderMail($donationOrder, $userInfo));
                Mail::to($donation->user)->send(new AuthorDonationOrderMail($donationOrder, $userInfo));
            }

            $this->clearSessions();

            return to_route('frontend.donation.index', $donation->uuid)
                ->with('success', __('Thank you :name for donation.', ['name' => $userInfo['name']]));
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->clearSessions();

            throw $exception;
        }
    }

    public function invoicePayment($paymentInfo)
    {
        DB::beginTransaction();

        try {
            $invoiceData = Session::get('invoicePaymentData');
            $invoice = $invoiceData['invoice'];
            $gateway = $invoiceData['gateway'];
            $originalAmount = Session::get('amount');
            $userInfo = Session::get('userInfo');
            // Calculate Income, taxes etc
            $convertToDefaultAmount = convert_money($originalAmount, $invoice->currency);
            $getTax = calculate_taxes($convertToDefaultAmount, false);
            $getExtraCharge = calculate_extra_charge($convertToDefaultAmount, 'invoice_charge');
            $totalCharge = $getTax + $getExtraCharge;

            $convertToOwnerAmount = convert_money($convertToDefaultAmount, $invoice->owner->currency, true);
            $convertToOwnerCharge = convert_money($totalCharge, $invoice->owner->currency, true);

            // Add Income to Author Profile
            $wallet = $invoice->owner->wallet;
            $invoice->owner->update([
                'wallet' => $wallet + ($convertToOwnerAmount - $convertToOwnerCharge)
            ]);

            $invoice->update([
                'trx' => $paymentInfo['payment_id'],
                'paid_at' => now(),
                'gateway_id' => $gateway->id,
                'charge' => $convertToOwnerCharge,
                'rate' => $invoice->owner->currency->rate,
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'fields' => $paymentInfo['fields'],
                'data' => $paymentInfo['data'],
            ]);

            //Generate Transaction for buyers
            if (Auth::check()) {
                $convertToBuyerAmount = convert_money($convertToDefaultAmount, user_currency(), true);

                Transaction::create([
                    'name' => $userInfo['name'],
                    'email' => $userInfo['email'],
                    'user_id' => Auth::id(),
                    'currency_id' => Auth::user()->currency_id,
                    'amount' => - ($convertToBuyerAmount),
                    'charge' => null,
                    'rate' => user_currency()->rate,
                    'reason' => __('Invoice Payment sent to :name', ['name' => $invoice->owner->business_name ?? $invoice->owner->name]),
                    'type' => 'debit'
                ]);
            }

            //Generate Transaction for sellers
            Transaction::create([
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'user_id' => $invoice->owner_id,
                'currency_id' => $invoice->owner->currency_id,
                'amount' => $convertToOwnerAmount - $convertToOwnerCharge,
                'charge' => $convertToOwnerCharge,
                'rate' => $invoice->owner->currency->rate,
                'reason' => __('Invoice Payment received from :name', ['name' => $userInfo['name']]),
                'type' => 'credit'
            ]);

            DB::commit();

            // Send Email to Author and Customer
            if (config('system.queue.mail')) {
                Mail::to($userInfo['email'])->queue(new InvoicePaymentMail($invoice, $userInfo));
                Mail::to($invoice->owner)->queue(new AuthorInvoicePaymentMail($invoice, $userInfo));
            } else {
                Mail::to($userInfo['email'])->send(new InvoicePaymentMail($invoice, $userInfo));
                Mail::to($invoice->owner)->send(new AuthorInvoicePaymentMail($invoice, $userInfo));
            }


            $this->clearSessions();

            if (Auth::check()) {
                return to_route('user.transactions.index', 'invoice')
                    ->with('success', __('Thank you :name for payment.', ['name' => $userInfo['name']]));
            } else {
                return to_route('frontend.invoice.index', $invoice->uuid)
                    ->with('success', __('Thank you :name for payment.', ['name' => $userInfo['name']]));
            }
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->clearSessions();

            throw $exception;
        }
    }

    public function merchantPayment($paymentInfo)
    {
        DB::beginTransaction();

        try {
            $merchantPaymentData = Session::get('merchantPaymentData');
            $order = $merchantPaymentData['order'];
            $order = $order->website->mode ? WebOrder::findOrFail($order->id) : WebTestOrder::findOrFail($order->id);
            $gateway = $merchantPaymentData['gateway'];
            $userInfo = Session::get('userInfo');

            // Calculate Income, taxes etc
            $convertToDefaultAmount = convert_money($order->amount * $order->quantity, $order->currency);
            $getTax = calculate_taxes($convertToDefaultAmount, false);
            $getExtraCharge = calculate_extra_charge($convertToDefaultAmount, 'merchant_charge');
            $totalCharge = $getTax + $getExtraCharge;

            $convertToOwnerCharge = convert_money($totalCharge, $order->currency, true);

            $order->update([
                'gateway_id' => $gateway->id,
                'trx' => $paymentInfo['payment_id'],
                'paid_at' => Date::now(),
                'payment_status' => $paymentInfo['payment_status'],
                'charge' => -$convertToOwnerCharge,
                'rate' => $order->currency->rate
            ]);

            if ($order->website->mode) {
                $convertToOwnerAmount = convert_money($convertToDefaultAmount - $totalCharge, $order->user->currency, true);
                // Add Income to Author Profile
                $wallet = $order->user->wallet;
                $order->user->update([
                    'wallet' => $wallet + $convertToOwnerAmount
                ]);

                //Generate Transaction for buyers
                if (Auth::check()) {
                    $convertToBuyerAmount = convert_money($convertToDefaultAmount, user_currency(), true);

                    Transaction::create([
                        'name' => $userInfo['name'],
                        'email' => $userInfo['email'],
                        'user_id' => Auth::id(),
                        'currency_id' => Auth::user()->currency_id,
                        'amount' => -$convertToBuyerAmount,
                        'charge' => null,
                        'rate' => user_currency()->rate,
                        'reason' => __('Merchant payment sent to :name', ['name' => $order->user->business_name ?? $order->user->name]),
                        'type' => 'debit'
                    ]);
                }

                //Generate Transaction for sellers
                Transaction::create([
                    'name' => $userInfo['name'],
                    'email' => $userInfo['email'],
                    'user_id' => $order->user_id,
                    'currency_id' => $order->user->currency_id,
                    'amount' => $convertToOwnerAmount,
                    'charge' => -$convertToOwnerCharge,
                    'rate' => $order->user->currency->rate,
                    'reason' => __('Merchant payment received from :name', ['name' => $userInfo['name']]),
                    'type' => 'credit'
                ]);

                DB::commit();

                // Send Email to Author and Customer
                if ($order->website->email) {
                    if (config('system.queue.mail')) {
                        Mail::to($order->website->email)->queue(new MerchantPaymentMail($order));
                    } else {
                        Mail::to($order->website->email)->send(new MerchantPaymentMail($order));
                    }
                }
            }

            DB::commit();
            $this->clearSessions();

            return redirect($order->callback_url);
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->clearSessions();

            throw $exception;
        }
    }

    public function qrPayment($paymentInfo)
    {
        DB::beginTransaction();

        try {
            $qrPaymentData = Session::get('qrPaymentData');
            $user = $qrPaymentData['user'];
            $gateway = $qrPaymentData['gateway'];
            $originalAmount = Session::get('amount');
            $userInfo = Session::get('userInfo');

            // Calculate Income, taxes etc
            $convertToDefaultAmount = convert_money($originalAmount, $user->currency);
            $getTax = calculate_taxes($convertToDefaultAmount, false);
            $getExtraCharge = calculate_extra_charge($convertToDefaultAmount, 'qr_payment_charge');
            $totalCharge = $getTax + $getExtraCharge;

            $convertToOwnerAmount = convert_money($convertToDefaultAmount, $user->currency, true);
            $convertToOwnerCharge = convert_money($totalCharge, $user->currency, true);

            $qrPayment = Qrpayment::create([
                "seller_id" => $user->id,
                "gateway_id" => $gateway->id,
                "trx" => $paymentInfo['payment_id'],
                "amount" => $originalAmount,
                "name" => $userInfo['name'],
                "email" =>  $userInfo['email'],
                "comment" => 'asdf',
            ]);

            // Add Income to Author Profile
            $wallet = $user->wallet;
            $user->update([
                'wallet' => $wallet + ($convertToOwnerAmount - $convertToOwnerCharge)
            ]);

            //Generate Transaction for buyers
            if (Auth::check()) {
                $convertToBuyerAmount = convert_money($convertToDefaultAmount, user_currency(), true);
                $convertToBuyerCharge = convert_money($totalCharge, user_currency(), true);

                Transaction::create([
                    'name' => $userInfo['name'],
                    'email' => $userInfo['email'],
                    'user_id' => Auth::id(),
                    'currency_id' => Auth::user()->currency_id,
                    'amount' => - ($convertToBuyerAmount),
                    'charge' => $convertToBuyerCharge,
                    'rate' => user_currency()->rate,
                    'reason' => __('Payment sent to :name', ['name' => $user->business_name ?? $user->name]),
                    'type' => 'debit'
                ]);
            }

            //Generate Transaction for sellers
            Transaction::create([
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'user_id' => $user->user_id,
                'currency_id' => $user->currency_id,
                'amount' => $convertToOwnerAmount - $convertToOwnerCharge,
                'charge' => $convertToOwnerCharge,
                'rate' => $user->currency->rate,
                'reason' => __('Payment received from :name', ['name' => $userInfo['name']]),
                'type' => 'credit'
            ]);

            DB::commit();

            $this->clearSessions();
            if (Auth::check()) {
                return to_route('user.transactions.index', 'qr-code')->with('success', __('Payment Successfully Completed'));
            } else {
                return to_route('frontend.qr.index', $user->qr)->with('success', __('Thanks! We received your payment'));
            }
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->clearSessions();

            throw $exception;
        }
    }

    public function test(Request $request, $website, $order, $gateway)
    {
        if ($request->input('status') == 'success') {
            $array = Session::get('testData');
            $amount = $array['amount'];
            //$totalAmount=$array['pay_amount'];
            $name = $array['name'];
            $billName = $array['billName'];
            $test_mode = $array['test_mode'];
            $info['payment_mode'] = 'credit';
            $info['amount'] = $amount;
            $info['test_mode'] = $test_mode;
            $info['charge'] = $array['charge'];
            $info['main_amount'] = $array['pay_amount'];
            $info['gateway_id'] = $array['gateway_id'];
            $info['payment_type'] = $array['payment_type'];

            $data['payment_id'] = \Str::random(10);
            $data['payment_method'] = "test";
            $data['gateway_id'] = $info['gateway_id'];
            $data['payment_type'] = $info['payment_type'];
            $data['amount'] = $info['main_amount'];
            $data['charge'] = $info['charge'];
            $data['status'] = 1;
            $data['payment_status'] = 1;

            Session::put('payment_info', $data);

            return redirect(Session::has('fund_callback') ? Session::get('fund_callback')['success_url'] : url('user/payment/success'));
        } else {
            $data['status'] = 0;
            $data['payment_status'] = 0;
            Session::put('payment_info', $data);
            Session::flash('error', __("Payment Canceled"));

            return redirect(Session::has('fund_callback') ? Session::get('fund_callback')['cancel_url'] : url('user/payment/failed'));
        }
    }
}
