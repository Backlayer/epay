<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
class CronController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:cron-settings-read')->only('index');
        $this->middleware('permission:cron-settings-update')->except('store');
    }
    public function index()
    {
        $cron = get_option('cron_option', true, 'en');

        return view('admin.cron.cron', compact( 'cron'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_expire_days' => ['integer', 'string'],
            'second_expire_days' => ['integer', 'string'],
            'first_alert_message' => ['required', 'string'],
            'second_alert_message' => ['required', 'string'],
            'expire_message' => ['required', 'string'],
            'trial_expired_message' => ['required', 'string'],
        ]);

        Option::updateOrCreate([
            'key' => 'cron_option',
            'lang' => 'en'
        ], [
           'value' => [
               'first_expire_days' => $request->input('first_expire_days'),
               'second_expire_days' => $request->input('second_expire_days'),
               'first_alert_message' => $request->input('first_alert_message'),
               'second_alert_message' => $request->input('second_alert_message'),
               'expire_message' => $request->input('expire_message'),
               'trial_expired_message' => $request->input('trial_expired_message'),
           ]
        ]);

        \Cache::forget('cron_option');

        return response()->json(__('Cron Setting Updated Successfully'));
    }

}
