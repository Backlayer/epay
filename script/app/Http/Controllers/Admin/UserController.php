<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users-create')->only('create', 'store');
        $this->middleware('permission:users-read')->only('index', 'show');
        $this->middleware('permission:users-update')->only('edit', 'update');
        $this->middleware('permission:users-delete')->only('edit', 'destroy');
    }

    public function index(Request $request)
    {
         $users = User::whereRole('user')
            ->when($request->get('src') !== null, function ($query) use($request){
                $query->where('name', 'LIKE', '%'.$request->get('src').'%')
                    ->orWhere('username', 'LIKE', '%'.$request->get('src').'%')
                    ->orWhere('email', 'LIKE', '%'.$request->get('src').'%');
            })
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {

        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', Password::default()],
            'status' => ['required', Rule::in(0, 1)],
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $this->usernameGenerate($request->input('email')),
            'password' => bcrypt($request->input('password')),
            'email_verified_at' => now()
        ]);

        return response()->json([
            'message' => __("User Created Successfully"),
            'redirect' => route('admin.users.show', $user->id)
        ]);
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
       $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,id,'.$user->id],
            'password' => ['nullable', Password::default()],
            'status' => ['required'],
        ]);

        $user->update([
            'password' => $request->input('password') == null ? $user->password : bcrypt($request->input('password'))
        ] + $validated);

        return response()->json([
            'message' => __("User Updated Successfully"),
            'redirect' => route('admin.users.show', $user->id)
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => __('User Deleted Successfully'),
            'redirect' => url()->previous()
        ]);
    }


    private function usernameGenerate($email)
    {
        $explodeEmail = explode('@', $email);
        $username = $explodeEmail[0];
        $count_username = User::where('username', $username)->count();
        if ($count_username > 0) {
            $username = $username . $count_username + 1;
        }

        return $username;
    }

    public function login(User $user)
    {
        Auth::logout();
        Auth::login($user);

        return response()->json([
            'message' => __('You are logged in as :name', ['name' => $user->name]),
            'redirect' => route('user.dashboard.index')
        ]);
    }
}
