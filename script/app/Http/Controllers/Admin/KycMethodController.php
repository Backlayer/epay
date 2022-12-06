<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KycMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kyc-methods-create')->only('create', 'store');
        $this->middleware('permission:kyc-methods-read')->only('index', 'show');
        $this->middleware('permission:kyc-methods-update')->only('edit', 'update');
        $this->middleware('permission:kyc-methods-delete')->only('edit', 'destroy', 'massDestroy');
    }

    public $types = ['text', 'number', 'email', 'tel', 'textarea', 'file'];

    public function index(){
        $kycMethods = KycMethod::latest()->paginate(20);
        return view('admin.kycmethod.index',compact('kycMethods'));
    }

    public function create(){
        $types = $this->types;

        return view('admin.kycmethod.create', compact('types'));
    }

    public function store(Request $request){

        $request->validate([
            'image' => ['required', 'string'],
            'title' => ['required', 'string'],
            'image_accept' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
            'fields' => ['required', 'array'],
            'fields.*.label' => ['required', 'string'],
            'fields.*.type' => ['required', 'string', Rule::in($this->types)],
        ]);


        KycMethod::create([
            'title' => $request->input('title'),
            'image' => $request->input('image'),
            'image_accept' => $request->input('image_accept'),
            'status' => $request->input('status'),
            'fields' => $request->input('fields'),
        ]);

        return response()->json([
            'message' => __('Kyc Method Added Successfully'),
            'redirect' => route('admin.kyc-method.index')
        ]);
    }

    public function edit(KycMethod $kycMethod){
        $types = $this->types;

        return view('admin.kycmethod.edit',compact('kycMethod','types'));
    }

    public function update(Request $request, KycMethod $kycMethod){
        $request->validate([
            'image' => ['required', 'string'],
            'title' => ['required', 'string'],
            'image_accept' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
            'fields' => ['required', 'array'],
            'fields.*.label' => ['required', 'string'],
            'fields.*.type' => ['required', 'string', Rule::in($this->types)],
        ]);

        $kycMethod->update([
            'title' => $request->input('title'),
            'image' => $request->input('image'),
            'image_accept' => $request->input('image_accept'),
            'status' => $request->input('status'),
            'fields' => $request->input('fields'),
        ]);

        return response()->json([
            'message' => __('Kyc Method Updated Successfully'),
            'redirect' => route('admin.kyc-method.index')
        ]);
    }

    public function massDestroy(Request $request){
        if ($request->ids){
            foreach ($request->ids as $id) {
                $kycMethod = KycMethod::find($id);
                if ( file_exists($kycMethod->image)) {
                    Storage::delete($kycMethod->image);
                }
                $kycMethod->delete();
            }
        }else{
            response()->json([
                'message' => __('Methods not found')
            ], 422);
        }
        return response()->json([
            'message' => __('Kyc Method Deleted Successfully'),
            'redirect' => route('admin.kyc-method.index')
        ]);
    }

}
