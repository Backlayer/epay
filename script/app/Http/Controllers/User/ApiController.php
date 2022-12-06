<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Str;

class ApiController extends Controller
{
    public function index()
    {
        return view('user.apikeys.index');
    }

    public function store()
    {
        Auth::user()->update([
            'public_key' => "PUBLIC-". Str::random(32),
            'secret_key' => "SECRET-". Str::random(32),
        ]);

        return response()->json([
            'message' => __('Api Key Re-Generated Successfully'),
            'redirect' => route('user.api-keys.index')
        ]);
    }
}
