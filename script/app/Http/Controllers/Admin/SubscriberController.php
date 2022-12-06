<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Newsletter;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Newsletter::getMembers();
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function unsubscribe($email)
    {
        Newsletter::unsubscribe($email);

        return response()->json([
            'message' => __('Unsubscribe Successful'),
            'redirect' => route('admin.subscribers.index')
        ]);
    }

    public function destroy($email)
    {
        Newsletter::deletePermanently($email);

        return response()->json([
            'message' => __('Subscriber Permanently Deleted'),
            'redirect' => route('admin.subscribers.index')
        ]);
    }
}
