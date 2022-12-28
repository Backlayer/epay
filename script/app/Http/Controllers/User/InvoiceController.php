<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Mail\InvoiceMail;
use App\Models\InvoiceItem;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Rules\Phone;
use App\Lib\Twilio;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::whereOwnerId(Auth::id())->with('currency')->withSum('items', 'subtotal')->latest()->paginate();
        return view('user.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $charge = get_option('charges')['invoice_charge'] ?? ['rate' => 0, 'type' => 'percentage'];

        return view('user.invoices.create', compact('charge'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_name' => ['required', 'string', 'max:255'],
            'items.*.amount' => ['required', 'numeric'],
            'items.*.quantity' => ['required', 'integer'],
            'invoice_no' => ['required', 'unique:invoices,invoice_no'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone_number' => ['nullable', new Phone],
            'due_date' => ['required', 'date'],
            'tax' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $items = [];
        $subTotal = null;
        foreach ($request->input('items') as $index => $item) {
            $items[] = $item;
            $subTotal += $item['amount'] * $item['quantity'];
        }


        $discount = ($subTotal * $validated['discount']) / 100;
        $tax = (($subTotal - $discount) * $validated['tax']) / 100;
        $total = ($subTotal - $discount) + $tax;

        $invoice = DB::transaction(function () use ($request, $total, $validated) {
            $invoice = Invoice::create([
                "invoice_no" => $validated['invoice_no'],
                "tax" => $validated['tax'],
                "discount" => $validated['discount'],
                "total" => $total,
                "customer_email" => $validated['customer_email'],
                "customer_phone_number" => $validated['customer_phone_number'],
                "due_date" => Carbon::parse($validated['due_date']),
                "note" => $validated['note'],
                "owner_id" => Auth::id(),
                "currency_id" => user_currency()->id,
            ]);

            foreach ($request->input('items') as $item) {
                $invoice->items()->create([
                    'name' => $item['item_name'],
                    'amount' => $item['amount'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['amount'] * $item['quantity'],
                ]);
            }

            return $invoice;
        });

        return response()->json([
            'message' => __('Invoice Generated Successfully'),
            'redirect' => route('user.invoices.show', $invoice->id)
        ]);
    }

    public function show(Invoice $invoice)
    {
        abort_if((int)$invoice->owner_id !== Auth::id(), 404);
        $invoice->load('items', 'currency');
        $invoice->loadSum('items', 'subtotal');
        $subTotal = $invoice->items_sum_subtotal;
        $discount = ($subTotal * $invoice->discount) / 100;
        $tax = (($subTotal - $discount) * $invoice->tax) / 100;
        $total = ($subTotal - $discount) + $tax;

        return view('user.invoices.show', compact('invoice', 'total'));
    }

    public function send(Invoice $invoice)
    {
        abort_if((int)$invoice->owner_id !== Auth::id(), 404);

        if (config('system.queue.mail')) {
            Mail::to($invoice->customer_email)->queue(new InvoiceMail($invoice));
        } else {
            Mail::to($invoice->customer_email)->send(new InvoiceMail($invoice));
        }

        $invoice->is_sent = true;
        $invoice->save();

        if ($invoice->customer_phone_number) {
            $invoice_currency = Currency::findOrFail($invoice->currency_id);
            $amount = $invoice_currency->symbol . number_format($invoice->total, 2);
            $link = route('frontend.invoice.index', $invoice->uuid);

            $twilio = new Twilio();
            $twilio->sendLink(
                $invoice->customer_phone_number,
                auth()->user()->meta['business_name'] ?? auth()->user()->name,
                $amount,
                $link
            );
        }

        return response()->json([
            'message' => __('Invoice sent to customer email'),
            'redirect' => route('user.invoices.index')
        ]);
    }

    public function edit(Invoice $invoice)
    {
        $userId = Auth::id();

        abort_if((int)$invoice->owner_id !== Auth::id(), 404);
        abort_if($invoice->IsConfirmed, 403, __('Invoice is already paid'));

        $charge = get_option('charges')['invoice_charge'] ?? ['rate' => 0, 'type' => 'percentage'];
        return view('user.invoices.edit', compact('invoice', 'charge'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        abort_if((int)$invoice->owner_id !== Auth::id(), 404);
        abort_if($invoice->IsConfirmed, 403, __('Invoice is already paid'));

        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_name' => ['required', 'string', 'max:255'],
            'items.*.amount' => ['required', 'numeric'],
            'items.*.quantity' => ['required', 'integer'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone_number' => ['nullable', new Phone],
            'due_date' => ['required', 'date'],
            'tax' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        $items = [];
        $subTotal = null;
        foreach ($request->input('items') as $index => $item) {
            $items[] = $item;
            $subTotal += $item['amount'] * $item['quantity'];
        }


        $discount = ($subTotal * $validated['discount']) / 100;
        $tax = (($subTotal - $discount) * $validated['tax']) / 100;
        $total = ($subTotal - $discount) + $tax;

        $invoice = DB::transaction(function () use ($request, $total, $validated, $invoice) {
            $invoice->update([
                "tax" => $validated['tax'],
                "discount" => $validated['discount'],
                "total" => $total,
                "customer_email" => $validated['customer_email'],
                "customer_phone_number" => $validated['customer_phone_number'],
                "due_date" => Carbon::parse($validated['due_date']),
                "note" => $validated['note'],
                "owner_id" => Auth::id(),
                "currency_id" => user_currency()->id,
            ]);

            foreach ($request->input('items') as $item) {
                $invoice->items()->delete();
                $invoice->items()->create([
                    'name' => $item['item_name'],
                    'amount' => $item['amount'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['amount'] * $item['quantity'],
                ]);
            }

            return $invoice;
        });

        return response()->json([
            'message' => __('Invoice Updated Successfully'),
            'redirect' => route('user.invoices.show', $invoice->id)
        ]);
    }

    public function destroy(Invoice $invoice)
    {
        abort_if($invoice->owner_id !== Auth::id(), 404);

        if ($invoice->IsConfirmed) {
            return response()->json([
                'message' => __('You are not allowed to delete this invoice'),
            ], 403);
        }

        $invoice->delete();

        return response()->json([
            'message' => __('Invoice Deleted Successfully'),
            'redirect' => route('user.invoices.index')
        ]);
    }

    public function getInvoices()
    {
        $data['invoices'] = Invoice::whereOwnerId(auth()->id())->count();
        return response()->json($data);
    }
}
