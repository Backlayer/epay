<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? response()->json([
                'message' => __('Logged In Successfully'),
                'redirect' => $this->redirectPath()
            ])
            : redirect()->intended($this->redirectPath());
    }

    protected function authenticated(Request $request, User $user)
    {
        $user->timestamps = false;
        $user->update([
            'last_login_at' => now(),
            'ip_address' => $request->ip(),
        ]);
    }

    public function redirectTo()
    {
        $auth = Auth::user();

        if (Auth::user()->role == 'admin') {
            return $this->redirectTo = route('admin.dashboard.index');
        }
        if ($auth->role == 'user') {
            return $this->redirectTo = route('user.dashboard.index');
        }

        $this->middleware('guest')->except('logout');
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([
                'message' => __('Logged Out Successfully'),
                'redirect' => url('/')
            ], 204)
            : redirect('/');
    }

    public function loginWithToken(User $user)
    {
        Auth::logout();
        Auth::login($user);

        Session::flash('success', __('Logged In Successfully'));

        return redirect()->intended($this->redirectPath());
    }
}
