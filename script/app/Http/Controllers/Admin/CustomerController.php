<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendEmailToCustomer;
use App\Models\Deposit;
use App\Models\User;
use App\Rules\Phone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:customers-create')->only('create', 'store');
        $this->middleware('permission:customers-read')->only('index', 'show');
        $this->middleware('permission:customers-update')->only('edit', 'update');
        $this->middleware('permission:customers-delete')->only('edit', 'destroy');
    }
    public function index(Request $request)
    {
        $search = $request->get('src');

        $customers = User::whereRole('user')
            ->when(!is_null($search), function (Builder $builder) use ($search){
                $builder->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('username', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%')
                    ->orWhere('phone', 'LIKE', '%'.$search.'%');
            })
            ->latest()
            ->paginate();
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        $customer->loadSum(['deposits', 'transactions'], 'amount');
        return view('admin.customers.show', compact('customer'));
    }

    public function edit(User $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'business_name' => ['required', 'string'],
            'name' => ['required', 'string'],
            'phone' => ['required', new Phone()],
            'wallet' => ['nullable', 'numeric'],
        ]);

        $meta = [
            'address' => $customer->address,
            'description' => $customer->description,
            'business_name' => $customer->business_name,
        ];

        $customer->update([
            'meta' => $meta,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'wallet' => $validated['wallet'],
        ]);

        return response()->json([
            'message' => __('Customer Updated Successfully')
        ]);
    }

    public function destroy(User $customer)
    {
        $customer->delete();

        return response()->json([
            'message' => __('Customer Deleted Successfully'),
            'redirect' => route('admin.customers.index')
        ]);
    }

    public function sendEmail(Request $request, User $user)
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string']
        ]);

        if (config('system.queue.mail')){
            Mail::to($user)->queue(new SendEmailToCustomer($request->subject, $request->message));
        }else{
            Mail::to($user)->send(new SendEmailToCustomer($request->subject, $request->message));
        }

        return response()->json([
            'message' => __('Email Sent Successfully')
        ]);
    }

    public function getCustomers()
    {
        $data['total'] = User::whereRole('user')->count();
        $data['active'] = User::whereRole('user')->whereStatus(1)->count();
        $data['pause'] = User::whereRole('user')->whereStatus(2)->count();
        $data['suspand'] = User::whereRole('user')->whereStatus(0)->count();
        return response()->json($data);
    }

    public function Login(User $user)
    {
        auth()->login($user);
        if (auth()->check()) {
            return response()->json([
                'message' => __("Login successfully."),
                'redirect' => route('user.dashboard.index'),
            ]);
        }
        return response()->json([
            'message' => __("Something was wrong."),
        ], 404);
    }
}
