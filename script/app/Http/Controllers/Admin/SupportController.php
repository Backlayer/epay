<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\SupportMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:supports-create')->only('create', 'store');
        $this->middleware('permission:supports-read')->only('index', 'show');
        $this->middleware('permission:supports-update')->only('edit', 'update');
        $this->middleware('permission:supports-delete')->only('edit', 'destroy');
    }

    public function index()
    {
        $supports = Support::with(['meta.sender', 'user'])->latest()->paginate(5);
        $replies = $supports->first() ? $supports->first()->meta()->with('sender')->latest()->limit(10)->get() : [];
        return view('admin.support.index', compact('supports', 'replies'));
    }

    public function getSupport(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:supports']
        ]);

        $support = Support::findOrFail($request->input('id'));
        $support->load('meta.sender');
        $replies = $support->meta()->with('sender')->latest()->limit(10)->get();

        return view('admin.support.ticket', compact('support', 'replies'))->render();
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => ['required', 'exists:supports'],
            'status' => ['boolean']
        ]);

        $support = Support::findOrFail($request->input('id'));
        $status = $request->input('status');
        $support->update([
            'status' => $status
        ]);

        return response()->json([
            'message' => __("Support has been :status", ['status' => $status ? __('opened') : __('closed')])
        ]);
    }

    public function reply(Request $request, Support $support)
    {
        $request->validate([
            'reply' => ['required', 'string']
        ]);

        $reply = $support->meta()->create([
            'type' => 1,
            'comment' => $request->input('reply'),
            'sender_id' => Auth::id()
        ]);

        $reply = view('admin.support.reply', compact('reply'))->render();

        return response()->json([
            'message' => __('Reply sent successfully'),
            'reply' => $reply
        ]);
    }
}
