<?php

namespace App\Http\Middleware;

use Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Session;

class KycMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && !Auth::user()->kyc_verified_at){
            if(config('system.kyc_verification')){
                if(!Auth::user()->kyc_verified_at){
                    Session::flash('warning', __('You have to verify your KYC'));
                    return to_route('user.kyc-verifications.index');
                }
            }
        }
        return $next($request);
    }
}
