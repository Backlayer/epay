<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:taxes-create')->only('create', 'store');
        $this->middleware('permission:taxes-read')->only('index', 'show');
        $this->middleware('permission:taxes-update')->only('edit', 'update');
        $this->middleware('permission:taxes-delete')->only('edit', 'destroy');
    }

    public function index()
    {
        $taxes = Tax::all();

        return view('admin.taxes.index', compact('taxes'));
    }

    public function create()
    {
        $types = Tax::types();

        return view('admin.taxes.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:taxes,name'],
            'rate' => ['required', 'numeric'],
            'type' => ['required', 'string', Rule::in(Tax::types())],
            'status' => ['required', 'bool'],
        ]);

        Tax::create($validated);

        return response()->json([
            'message' => __('Tax Created Successfully'),
            'redirect' => route('admin.taxes.index')
        ]);
    }

    public function edit(Tax $tax)
    {
        $types = Tax::types();

        return view('admin.taxes.edit', compact('tax', 'types'));
    }

    public function update(Request $request, Tax $tax)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', Rule::unique('taxes')->ignore($tax->id)],
            'rate' => ['required', 'numeric'],
            'type' => ['required', 'string', Rule::in(Tax::types())],
            'status' => ['required', 'bool'],
        ]);

        $tax->update($validated);

        return response()->json([
            'message' => __('Tax Updated Successfully'),
            'redirect' => route('admin.taxes.index')
        ]);
    }

    public function destroy(Tax $tax)
    {
        $tax->delete();

        return response()->json([
            'message' => __('Tax Deleted Successfully'),
            'redirect' => route('admin.taxes.index')
        ]);
    }
}
