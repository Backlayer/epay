<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Phone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:staff-create')->only('create', 'store');
        $this->middleware('permission:staff-read')->only('index', 'show');
        $this->middleware('permission:staff-update')->only('edit', 'update');
        $this->middleware('permission:staff-delete')->only('edit', 'destroy');
    }

    public function index(Request $request)
    {
        $staff = User::whereRole('admin')->with('roles')->latest()->paginate();

        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', Rule::unique('users', 'email')],
            'phone' => ['required', new Phone],
            'username' => ['required', Rule::unique('users', 'username')],
            'role' => ['required', Rule::in(Role::all()->pluck('name', 'id')->values()->toArray())]
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'username' => $validated['username'],
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);
        $user->assignRole($validated['role']);
        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => __("Staff Created Successfully"),
            'redirect' => route('admin.staff.index')
        ]);
    }

    public function edit(User $staff)
    {
        $roles = Role::all();
        return view('admin.staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, User $staff)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', Rule::unique('users', 'email')->ignore($staff->id)],
            'phone' => ['required', new Phone],
            'username' => ['required', Rule::unique('users', 'username')->ignore($staff->id)],
            'role' => ['required', Rule::in(Role::all()->pluck('name', 'id')->values()->toArray())]
        ]);

        $staff->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'username' => $validated['username'],
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);
        $staff->syncRoles($validated['role']);

        return response()->json([
            'message' => __("Staff Updated Successfully"),
            'redirect' => route('admin.staff.index')
        ]);
    }

    public function destroy(User $staff)
    {
        $staff->delete();

        return response()->json([
            'message' => __("Staff Deleted Successfully"),
            'redirect' => route('admin.staff.index')
        ]);
    }
}
