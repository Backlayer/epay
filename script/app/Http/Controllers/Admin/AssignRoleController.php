<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

class AssignRoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:roles-assign-read')->only('index','search');
        $this->middleware('permission:roles-assign-create')->only('store');
    }

    public function index(Request $request)
    {
        $roles = Role::all();
        return view('admin.roles.assign-role', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user' => ['required', 'exists:users,id'],
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'exists:roles,id']
        ]);

        $user = User::findOrFail($request->input('user'));
        $user->roles()->sync($request->input('roles'));

        return response()->json([
            'message' => __('Role Successfully Assigned'),
            'redirect' => route('admin.assign-role.index')
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if (!is_null($search)){
            $users = User::orderby('name','asc')
                ->select('id','name as text', 'avatar')
                ->where('name', 'like', '%' .$search . '%')
                ->paginate(20);
        }else{
            return response()->json();
        }

        return response()->json($users);
    }
}
