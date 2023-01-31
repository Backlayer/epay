<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Currency;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\Phone;
use App\Helpers\HasFields;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use HasFields;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->setFields();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'business_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', new Phone()],
            'password' => ['required', Password::default()],
            'agree' => ['accepted'],
        ], [
            'agree.accepted' => __('You have to must agree with our terms & conditions')
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => usernameGenerate($request->email),
            'password' => Hash::make($request->password),
            'currency_id' => 1,
            'meta' => [
                "business_name" => $request->business_name
            ],
            'data' => $this->getFields($request) ?? null,
            'fields' => $this->signupFields ?? null
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request)));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([
                'message' => __('Registration Successful'),
                'redirect' => route('user.set-bank.index')
            ], 201)
            : redirect()->route('user.set-bank.index');
    }

    public function showRegistrationForm()
    {
        $countries = Currency::whereStatus(1)
            ->groupBy('country_name')
            ->pluck('country_name', 'id');

        $signupFields = $this->signupFields;

        return view('auth.register', compact('countries', 'signupFields'));
    }
}