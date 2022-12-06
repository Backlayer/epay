<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Models\Option;
use Cache;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:languages-create')->only('create', 'store');
        $this->middleware('permission:languages-read')->only('index', 'show');
        $this->middleware('permission:languages-update')->only('edit', 'update');
        $this->middleware('permission:languages-delete')->only('edit', 'destroy');
    }
    public function index()
    {
        $posts = Option::where('key', 'languages')->first();
        $posts = $posts->value ?? null;

        $actives = Option::where('key', 'active_languages')->first();
        if (!empty($actives)) {
            $data = [];
            foreach ($actives->value ?? [] as $key => $value) {
                array_push($data, $key);
            }
            $actives = $data;

        } else {
            $actives = [];
        }

        return view('admin.language.index', compact('posts', 'actives'));

    }

    public function create()
    {
        $countries = base_path('lang/langlist.json');
        $countries = json_decode(file_get_contents($countries), true);

        return view('admin.language.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'language_code' => ['required', 'string']
        ]);

        $file = lang_path($request->input('language_code') . '.json');
        if (!file_exists($file)){
            copy(lang_path('default.json'), $file);
        }

        $arr = [];

        $langlist = Option::where('key', 'languages')->first();
        if (!empty($langlist)) {
            $langs = $langlist->value;
            foreach ($langs as $key => $value) {
                $arr[$key] = $value;
            }
        }

        $arr[$request->language_code] = $request->name;

        if (empty($langlist)) {
            $langlist = new Option;
            $langlist->key = 'languages';
        }
        $langlist->value = $arr;
        $langlist->save();

        Cache::forget('languages');

        return response()->json([
            'message' => __('Language Created Successfully'),
            'redirect' => route('admin.language.index')
        ]);
    }

    public function show($id)
    {
        $file = base_path('lang/' . $id . '.json');
        if (!file_exists($file)){
            copy(base_path('lang/en.json'), $file);
        }
        $phrases = file_get_contents($file);
        $phrases = json_decode($phrases);
        return view('admin.language.edit', compact('phrases', 'id'));
    }

    public function update(Request $request, $id)
    {
        $data = [];
        foreach ($request->values as $key => $row) {
            $data[$key] = $row;
        }
        $file = json_encode($data, JSON_PRETTY_PRINT);
        File::put(base_path('lang/' . $id . '.json'), $file);
        Cache::forget('languages');

        return response()->json(__("Phrase Updated Successfully"));
    }

    public function setActiveLanguage(Request $request)
    {
        $posts = Option::where('key', 'active_languages')->first();
        $actives = json_decode($posts->value ?? '');
        $active_languages = [];

        foreach ($request->ids as $key => $value) {
            foreach ($value as $k => $row) {
                $active_languages[$row] = $k;
            }
        }
        if (empty($posts)) {
            $posts = new Option;
            $posts->key = 'active_languages';
        }
        $posts->value = json_encode($active_languages);
        $posts->save();
        Cache::forget('active_languages');
        return response()->json([
            'message' => __("Language Activated")
        ]);
    }

    public function destroy($id)
    {
        $posts = Option::where('key', 'languages')->first();
        $actives_lang = Option::where('key', 'active_languages')->first();

        $post = $posts->value ?? [];
        $actives = $actives_lang->value ?? '';

        $data = [];
        foreach ($post as $key => $row) {
            if ($id != $key) {
                $data[$key] = $row;
            }
        }

        $posts->value = $data;
        $posts->save();

        if (file_exists(base_path('lang/' . $id . '.json'))) {
            unlink(base_path('lang/' . $id . '.json'));
        }

        Cache::forget('languages');
        return redirect()->back()->with('success', __("Language Deleted Successfully"));
    }

    public function add_key(Request $request)
    {
        $request->validate([
            'key' => ['required', 'string']
        ]);

        $file = base_path('lang/' . $request->id . '.json');
        $posts = file_get_contents($file);
        $posts = json_decode($posts);
        foreach ($posts ?? [] as $key => $row) {
            $data[$key] = $row;
        }
        $data[$request->key] = $request->value;

        File::put(base_path('lang/' . $request->id . '.json'), json_encode($data, JSON_PRETTY_PRINT));
        Cache::forget('languages');
        return response()->json([
            'message' => __('New Phrase Added Successfully')
        ]);
    }
}
