<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Phone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class WebHookController extends Controller
{
    public function createAccount(Request $request, $secretKey)
    {
        $userAdmin = User::whereSecretKey($secretKey)->whereRole('admin')->whereStatus(1)->first();

        if (!$userAdmin) {
            return response()->json([
                'message' => 'User not found.',
                'status' => 'error'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'business_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', new Phone],
            'currency' => ['required', 'exists:currencies,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 403);
        }

        $username = usernameGenerate($request->email);
        $password = passwordGenerate(8);
        $redirect = route('login');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $username,
            'password' => Hash::make($password),
            'currency_id' => $request->currency,
            'meta' => [
                "business_name" => $request->business_name
            ],
        ]);

        $user->passw = $password;

        return response()->json([
            'message' => __('Registration Successful'),
            'status' => "success",
            'redirect' => $redirect,
            'data' => $user
        ]);
    }
}
