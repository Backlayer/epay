<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Newsletter;

class CommonController extends Controller
{
    public function upload(Request $request, $input = null)
    {
        $file = $request->file($input ?? 'file');
        $folder = uniqid() . '-' . now()->timestamp;
        $ext = $file->getClientOriginalExtension();
        $filename = now()->timestamp.'.'.$ext;

        Storage::disk(config('filesystems.default'))->put('temp/'. $folder.'/'.$filename, file_get_contents($file));

        TemporaryFile::create([
            'folder' => $folder,
            'filename' => $filename,
            'driver' => config('filesystems.default')
        ]);

        return response()->json([
            'folder' => $folder,
            'filename' => $filename
        ]);
    }

    public function subscribeToNewsLetter(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        Newsletter::subscribe($request->input('email'), [], 'subscribers');

        return response()->json( [
            'message' => __('Thanks for joining our newsletter')
        ]);
    }
}
