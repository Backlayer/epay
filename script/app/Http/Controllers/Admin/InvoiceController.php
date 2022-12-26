<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:invoices-read')->only('index', 'show');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $invoices = Invoice::with('currency', 'owner')
            ->when(!is_null($search), function (Builder $builder) use ($search) {
                $builder->whereHas('owner', function (Builder $builder) use ($search) {
                    $builder->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('username', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate();

        return view('admin.invoices.index', compact('invoices'));
    }

    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', compact('invoice'));
    }

    public function getInvoices()
    {
        $data['invoices'] = Invoice::count();
        $data['total_items'] = InvoiceItem::count();
        $data['total_quantity'] = InvoiceItem::sum('quantity');
        return response()->json($data);
    }

    public function confirm(Invoice $invoice)
    {
        abort_if($invoice->status_paid !== '1', 403, __('Invoice has not been paid'));

        $invoice->status_paid = '2';
        $invoice->save();

        return response()->json([
            'message' => __('Invoice Payment Confirmed Successfully'),
            'redirect' => route('admin.invoices.index')
        ]);
    }
}
