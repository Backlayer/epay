<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendPromotionalMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PromotionalEmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:promotional-email-create')->only('sendEmail');
        $this->middleware('permission:promotional-email-read')->only('index', 'show');
    }

    public function index()
    {
        return view('admin.promotionalEmail.index');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string']
        ]);

        $emails = User::whereRole('user')->whereStatus(1)->pluck('email')->toArray();

        if (config('system.queue.mail')){
            Mail::to($emails)->queue(new SendPromotionalMail($request->subject, $request->message));
        }else{
            Mail::to($emails)->send(new SendPromotionalMail($request->subject, $request->message));
        }

        return response()->json([
            'message' => __('Promotional email sent to all users')
        ]);
    }
}
