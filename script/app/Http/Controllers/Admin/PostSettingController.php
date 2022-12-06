<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class PostSettingController extends Controller
{
    public function index()
    {
        $podcast = Option::where('key', 'podcast')->first();

        return view('admin.settings.postsetting', compact('podcast'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'maximum_recording_time' => ['required', 'numeric'],
        ]);

        Option::updateOrCreate([
            'key' => 'podcast',
            'lang' => 'en'
        ], [
            'value' => [
                'maximum_recording_time' => $request->input('maximum_recording_time'),
            ]
        ]);

        return response()->json([
            'message' => __('Post Setting Updated Successfully')
        ]);
    }
}
