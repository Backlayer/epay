<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Artisan;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function settings()
    {
        return view('admin.admin.settings');
    }

    public function updateGeneral(Request $request)
    {
        $request->validate([
            'file' => 'image',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'name' => 'required',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json(__('Profile Updated Successfully'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                Rule::requiredIf(function () {
                    return Auth::user()->password != null;
                }),
                Password::default()
            ],
            'password' => ['required', 'string', 'confirmed', 'different:current_password'],
        ], [
            'password.different' => __('The current password and the new password cannot be the same')
        ]);

        $user = Auth::user();

        if ($user->password != null) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->update([
                    'password' => bcrypt($request->input('password'))
                ]);

                return response()->json(__('Password Changed Successfully'));
            } else {
                return response()->json(__("Oops! The current password doesn't match"), 401);
            }
        } else {
            $user->update([
                'password' => bcrypt($request->input('password'))
            ]);

            return response()->json(__('Password Changed Successfully'));
        }
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');

        return redirect()->back()->with('success', __('Cache Cleared Successfully'));
    }
}
