<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class MediaController extends Controller
{
    protected $filename;
    protected $ext;
    protected $fullname;
    protected $extension;

    public function __construct()
    {
        $this->middleware('permission:media-create')->only('create', 'store');
        $this->middleware('permission:media-read')->only('index', 'show');
        $this->middleware('permission:media-update')->only('edit', 'update');
        $this->middleware('permission:media-delete')->only('edit', 'destroy');
    }

    public function index(Request $request)
    {
        $row = Media::latest()->select('id', 'url')->paginate(12);
        return response()->json($row);
    }

    public function json(Request $request)
    {
        $row = Media::latest()->select('id', 'url')->paginate(12);
        return response()->json($row);
    }

    public function list()
    {
        $posts = Media::latest()->paginate(20);
        return view('admin.media.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'media.*' => 'required|image|max:3000'
        ]);

        $driver = config('filesystems.default');

        $auth_id = Auth::id();
        $images = [];

        $image = $request->file('media');

        $imageSizes = json_decode(imageSizes());

        $ext = strtolower($image->getClientOriginalExtension());
        $name = uniqid() . date('dmy') . time() . "." . strtolower($ext);

        $path = 'uploads/' . $auth_id . date('/y') . '/' . date('m') . '/';

        if ($driver == 'local') {
            $image->move($path, $name);
            $schemeurl = parse_url(url('/'));
            $file_url = asset($path . $name);
        } else {
            Storage::disk($driver)->put($path . $name, file_get_contents(Request()->file('media')));

            $file_url = Storage::disk($driver)->url($path . $name);
        }

        array_push($images, $path . $name);

        $imgArr = explode('.', $path . $name);

        foreach ($imageSizes as $size) {
            $imgname = $imgArr[0] . $size->key . '.' . $imgArr[1];
            if ($driver == 'local') {
                $img = Image::make($path . $name);
                $img->fit($size->width, $size->height);
                $img->save($imgname);
                $file_size = $img->filesize();

                array_push($images, $imgname);
            } else {
                $img = Image::make(Request()->file('media'))->fit($size->width, $size->height)->encode();
                Storage::disk($driver)->put($imgname, $img);
                $file_size = Storage::disk($driver)->size($imgname);

                array_push($images, $imgname);
            }
        }

        $images = json_encode($images);

        $media = new Media;
        $media->url = $file_url;
        $media->driver = $driver;
        $media->files = $images;
        $media->save();

        $responseData['url'] = $media->url;
        $responseData['id'] = $media->id;
        return $responseData;
    }

    public function show($id)
    {
        $media = Media::find($id);
        return response()->json($media);
    }

    public function destroy(Request $request)
    {
        if ($request->id) {
            if ($request->status == 'delete') {
                $storage_files = [];
                foreach ($request->id as $value) {
                    $media = Media::find($value);

                    if (!empty($media)) {
                        $files = json_decode($media->files);

                        foreach ($files as $file) {
                            if ($media->driver == 'local') {
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                            } else {
                                $storage_files[$media->driver][] = $file;
                            }
                        }
                        $media->delete();
                    }

                }
                try {
                    foreach ($storage_files ?? [] as $key => $value) {
                        if ($key != 'default') {
                            Storage::disk($key)->delete($value);
                        }

                    }

                } catch (Exception $e) {

                }
                return response()->json('Media Deleted');
            } else {
                $errors['errors']['error'] = __('Oops! Please select Any Status.');
                return response()->json($errors, 401);
            }
        } else {
            $errors['errors']['error'] = __('Oops! Please select Any Status.Please select any checkbox.');
            return response()->json($errors, 401);
        }
    }

    function getMb($set_bytes)
    {
        $set_kb = 1000;
        $set_mb = $set_kb * 1024;

        return str_replace(',', '', number_format($set_bytes / $set_mb, 4));
    }

}
