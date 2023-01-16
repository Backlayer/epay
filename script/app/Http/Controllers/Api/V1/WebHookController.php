<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\HasFields;
use App\Rules\Phone;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class WebHookController extends Controller
{
    use HasFields;

    public function __construct()
    {
        $this->setFields();
    }

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
            'phone' => ['required'],
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

        $validatePhone = new Phone();
        $isValidPhone = $validatePhone->isPhone($request->phone);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'isValidPhone' => $isValidPhone,
            'username' => $username,
            'password' => Hash::make($password),
            'currency_id' => 1,
            'meta' => [
                "business_name" => $request->business_name
            ],
            'data' => $this->getFields($request, false) ?? null,
            'fields' => $this->signupFields ?? null
        ]);

        $user->passw = $password;

        event(new Registered($user));

        return response()->json([
            'message' => __('Registration Successful'),
            'status' => "success",
            'redirect' => $redirect,
            'data' => $user
        ]);
    }
}
