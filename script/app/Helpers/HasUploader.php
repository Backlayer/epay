<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait HasUploader
{
    private function upload(Request $request, $input, $oldFile = null)
    {
        $file = $request->file($input);
        $ext = $file->getClientOriginalExtension();
        $filename = now()->timestamp.'.'.$ext;

        $path = 'uploads/' . \Auth::id() . date('/y') . '/' . date('m') . '/';
        $filePath = $path.$filename;

        if($oldFile) {
            if (file_exists($oldFile)) {
                Storage::delete($oldFile);
            }
        }

        Storage::disk(config('filesystems.default'))->put($filePath, file_get_contents($file));

        return $filePath;
    }
}
