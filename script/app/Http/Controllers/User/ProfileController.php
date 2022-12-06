<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
class ProfileController extends Controller
{

    use HasUploader;

    public function index()
    {
        return view('user.profiles.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'required|max:20',
            'name' => 'required|max:100',
            'address' => 'required|max:100',
            'description' => 'nullable|max:100',
            'image' => 'nullable|image:max:1024',
            'business_name' => 'required|max:100',
        ]);

        $user = User::findOrFail($id);
        $meta = [
            'address' => $request->address,
            'description' => $request->description,
            'business_name' => $request->business_name,
        ];

        if ($request->old_password || $request->new_password) {
            $request->validate([
                'old_password' => 'required|min:4|max:20',
                'new_password' => 'required|min:4|max:20',
            ]);

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'message' => __('Old password is wrong.')
                ], 402);
            }
        }

        $user->update([
            'meta' => $meta,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' => $request->image ? $this->upload($request, 'image') : $user->avatar,
            'password' => $request->new_password ? Hash::make($request->new_password) : $user->password,
        ]);

        return response()->json([
            'message' => __('Business profile updated successfully.')
        ]);
    }
}
