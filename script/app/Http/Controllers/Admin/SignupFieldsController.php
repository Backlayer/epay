<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\SignupFields;
use App\Helpers\HasFields;

class SignupFieldsController extends Controller
{
    use HasFields;

    private string $redirect;

    private function mapFields($request)
    {
        $data = null;

        foreach ($request->data as $key => $value) {
            if ($value['value']) {
                $data[] = $value;
            }
        }

        return [
            'label' => $request->label,
            'type' => $request->type,
            'order' => $request->order,
            'data' => $data,
            'isRequired' => isset($request->isRequired[0]),
            'isActive' => isset($request->isActive[0]),
        ];
    }

    private function validateFields($request)
    {
        $request->validate([
            'label' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in($this->types)],
            'order' => ['required', 'numeric', 'min:0'],
        ]);
    }

    public function __construct()
    {
        $this->redirect = route('admin.signup-fields.index');

        $this->middleware('permission:signup-fields-create')->only('create', 'store');
        $this->middleware('permission:signup-fields-read')->only('index', 'show');
        $this->middleware('permission:signup-fields-update')->only('edit', 'update');
        $this->middleware('permission:signup-fields-delete')->only('destroy');
    }

    public function index()
    {
        $signupFields = SignupFields::orderBy('order', 'ASC')->paginate(10);

        return view('admin.signupFields.index', compact('signupFields'));
    }

    public function create()
    {
        $types = $this->types;

        return view('admin.signupFields.create', compact('types'));
    }

    public function store(Request $request)
    {
        $this->validateFields($request);

        SignupFields::create($this->mapFields($request));

        return response()->json([
            'message' => __('Fields for Signup created successfully'),
            'redirect' => $this->redirect
        ]);
    }

    public function edit(SignupFields $signupField)
    {
        $types = $this->types;

        return view('admin.signupFields.edit', compact('signupField', 'types'));
    }

    public function update(Request $request, SignupFields $signupField)
    {
        $this->validateFields($request);

        $signupField->update($this->mapFields($request));

        return response()->json([
            'message' => __('Fields for Signup updated successfully'),
            'redirect' => $this->redirect
        ]);
    }

    public function destroy(SignupFields $signupField)
    {
        $signupField->delete();

        return response()->json([
            'message' => __('Field for Signup successfully removed'),
            'redirect' => $this->redirect
        ]);
    }
}