<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use App\Models\TermMeta;
use App\Service\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\str;
use Storage;
use DB;
use Auth;
use Cache;
use Throwable;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:blog-create')->only('create', 'store');
        $this->middleware('permission:blog-read')->only('index', 'show');
        $this->middleware('permission:blog-update')->only('edit', 'update');
        $this->middleware('permission:blog-delete')->only('edit', 'destroy');
    }
    public function index(Request $request)
    {
        $posts = Term::query();
        if (!empty($request->src)) {
            $posts = $posts->where('title', 'LIKE', '%' . $request->src . '%');
        }
        $posts = $posts->with('preview')->where('type', 'blog')->latest()->paginate(20);
        return view('admin.blog.index', compact('posts', 'request'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required',
            'excerpt' => 'required',
            'description' => 'required',
            'preview' => 'required',
        ]);
        DB::beginTransaction();
        try {
            // Term Data Store
            $post = new Term();
            $post->title = $request->name;
            $post->slug = Str::slug($request->name);
            $post->type = 'blog';
            $post->status = $request->status;

            $post->featured = $request->featured;
            $post->lang = $request->lang ?? 'en';
            $post->comment_status = $request->comment_status ?? 0;
            $post->save();

            $post->meta()->create([
                'key' => 'excerpt',
                'value' => $request->excerpt
            ]);

            $post->meta()->create([
                'key' => 'metatag',
                'value' => $request->metatag
            ]);
            $post->meta()->create([
                'key' => 'metadescription',
                'value' => $request->metadescription,
            ]);

            if(isset($request->preview)){
                $post->meta()->create([
                    'key' => 'preview',
                    'value' => $request->preview
                ]);
            }


            $post->meta()->create([
                'key' => 'description',
                'value' => $request->description
            ]);

            Cache::forget('website.home.'.current_locale());
            Cache::forget('website.blogs.'.current_locale());

            DB::commit();

            return response()->json([
                'message' => __("Blog Created Successfully"),
                'redirect' => route('admin.blog.index')
            ]);
        } catch (Throwable $th) {
            DB::rollback();
            $errors['errors']['error'] =$th->getMessage();
            return response()->json($errors, 401);
        }
    }

    public function edit($id)
    {
        $page = Term::findOrFail($id);
        return view('admin.blog.edit', compact('page'));
    }

    public function update(Request $request, Term $blog)
    {
        // Validate
        $request->validate([
            'name' => 'required',
            'excerpt' => 'required',
            'description' => 'required',
        ]);

        // Term Data Update
        DB::beginTransaction();
        try {
            $blog->title = $request->name;
            $blog->slug = $request->slug;
            $blog->status = $request->status;
            $blog->featured = $request->featured;
            $blog->lang = $request->lang ?? 'en';
            $blog->comment_status = $request->comment_status ?? 0;
            $blog->save();

            if ($request->excerpt) {
                if (empty($blog->excerpt)) {
                    $blog->excerpt()->create(['key' => 'excerpt', 'value' => $request->excerpt]);
                } else {
                    $blog->excerpt()->update(['value' => $request->excerpt]);
                }

            } else {
                if (!empty($blog->excerpt)) {
                    $blog->excerpt()->delete();
                }
            }

            if ($request->metatag) {
                if (empty($blog->metatag)) {
                    $blog->metatag()->create(['key' => 'metatag', 'value' => $request->metatag]);
                } else {
                    $blog->metatag()->update(['value' => $request->metatag]);
                }

            } else {
                if (!empty($blog->metatag)) {
                    $blog->metatag()->delete();
                }
            }

            if ($request->metadescription) {
                if (empty($blog->metadescription)) {
                    $blog->metadescription()->create(['key' => 'metadescription', 'value' => $request->metadescription]);
                } else {
                    $blog->metadescription()->update(['value' => $request->metadescription]);
                }

            } else {
                if (!empty($blog->metadescription)) {
                    $blog->metadescription()->delete();
                }
            }


            if ($request->description) {
                if (empty($blog->description)) {
                    $blog->description()->create(['key' => 'description', 'value' => $request->description]);
                } else {
                    $blog->description()->update(['value' => $request->description]);
                }

            } else {
                if (!empty($blog->description)) {
                    $blog->description()->delete();
                }
            }
            if ($request->preview) {
                if (empty($blog->preview)) {
                    $blog->preview()->create(['key' => 'preview', 'value' => $request->preview]);
                } else {
                    $blog->preview()->update(['value' => $request->preview]);
                }

            } else {
                if (!empty($blog->preview)) {
                    $blog->preview()->delete();
                }
            }


            DB::commit();

            Cache::forget('website.home.'.current_locale());
            Cache::forget('website.blogs.'.current_locale());

            return response()->json([
                'message' => __("Blog Updated Successfully"),
                'redirect' => route('admin.blog.index')
            ]);
        } catch (Throwable $th) {
            DB::rollback();
            $errors['errors']['error'] = $th->getMessage();
            return response()->json($errors, 401);
        }
    }

    public function destroy(Term $blog)
    {
        if (file_exists($blog->preview->value)) {
            unlink($blog->preview->value);
        }
        $blog->delete();
        Cache::forget('website.blogs.'.current_locale());
        Cache::forget('website.home.'.current_locale());
        return redirect()->back()->with('success', 'Successfully Deleted');
    }

    public function deleteAll(Request $request){
        foreach ($request->ids as $id) {
            $blog = Term::find($id);
            if (file_exists($blog->preview->value)) {
                unlink($blog->preview->value);
            }
            $blog->delete();
        }
        Cache::forget('website.blogs.'.current_locale());
        Cache::forget('website.home.'.current_locale());
        return response()->json([
            'message' => __("Blog Deleted Successfully"),
            'redirect' => route('admin.blog.index')
        ]);
    }
}
