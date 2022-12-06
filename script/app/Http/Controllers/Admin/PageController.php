<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use App\Models\TermMeta;
use Illuminate\Http\Request;
use Illuminate\Support\str;
use Cache;
use DB;
use Throwable;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pages-create')->only('create', 'store');
        $this->middleware('permission:pages-read')->only('index', 'show');
        $this->middleware('permission:pages-update')->only('edit', 'update');
        $this->middleware('permission:pages-delete')->only('edit', 'destroy');
    }

    public function index()
    {
        $all_page = Term::where('type', 'page')->orderBy('id','desc')->paginate(20);
        return view('admin.page.index', compact('all_page'));
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'page_title' => 'required',
            'status' => 'required',
        ]);

        // Data
        $data = [
            'page_excerpt' => $request->page_excerpt,
            'page_content' => $request->page_content,
            'metatag' => $request->metatag,
            'metadescription' => $request->metadescription,
        ];

        // Page Data Store
        $page_store = new Term();
        $page_store->title = $request->page_title;
        $page_store->slug = Str::slug($request->page_title);
        $page_store->type = 'page';
        $page_store->status = $request->status;
        $page_store->featured = 1;
        $page_store->save();

        // page Meta data store
        $page_meta_store = new TermMeta();
        $page_meta_store->term_id = $page_store->id;
        $page_meta_store->key = 'page';
        $page_meta_store->value = json_encode($data);
        $page_meta_store->save();

        return response()->json([
            'message' => __("Page Created Successfully"),
            'redirect' => route('admin.page.index')
        ]);
    }

    public function aboutUpdate(Request $request, $lang)
    {
        DB::beginTransaction();
        try {

            $block1 = Term::where('type', 'about_block1')->where('lang', $lang)->first();
            $block1_check = $block1;
            if (empty($block1)) {
                $block1 = new Term();
            }

            $block1->title = $request->block1_short_title;
            $block1->slug = Str::slug($request->block1_short_title);
            $block1->type = 'about_block1';
            $block1->status = $request->block1_status;
            $block1->lang = $lang;
            $block1->save();

            if (empty($block1_check)) {
                $block1->description()->create(['key' => 'description', 'value' => json_encode($request->block1)]);
            } else {
                $block1->description()->update(['value' => json_encode($request->block1)]);
            }

            $block2 = Term::where('type', 'about_block2')->where('lang', $lang)->first();
            $block2_check = $block2;
            if (empty($block2)) {
                $block2 = new Term();
            }

            $block2->title = $request->block2_short_title;
            $block2->slug = Str::slug($request->block2_short_title);
            $block2->type = 'about_block2';
            $block2->status = $request->block2_status;
            $block2->lang = $lang;
            $block2->save();

            if (empty($block2_check)) {
                $block2->description()->create(['key' => 'description', 'value' => json_encode($request->block2)]);
            } else {
                $block2->description()->update(['value' => json_encode($request->block2)]);
            }

            DB::commit();
        } catch (Throwable $th) {
            DB::rollback();
            return $th;
        }

        Cache::forget('about_block1' . $lang);
        Cache::forget('about_block2' . $lang);
        return response()->json([
            'message' => __("Page Updated Successfully"),
            'redirect' => route('admin.page.index')
        ]);
    }

    public function chooseUpdate(Request $request, $lang)
    {
        DB::beginTransaction();
        try {
            $choose = Term::where('type', 'choose')->where('lang', $lang)->first();
            $choose_check = $choose;
            if (empty($choose)) {
                $choose = new Term();
            }

            $choose->title = $request->short_title;
            $choose->slug = $request->long_title;
            $choose->type = 'choose';
            $choose->lang = $lang;
            $choose->save();

            if (empty($choose_check)) {
                $choose->description()->create(['key' => 'description', 'value' => json_encode($request->data)]);
            } else {
                $choose->description()->update(['value' => json_encode($request->data)]);
            }

            if (empty($choose_check)) {
                $choose->preview()->create(['key' => 'preview', 'value' => $request->preview]);
            } else {
                $choose->preview()->update(['value' => $request->preview]);
            }

            DB::commit();
        } catch (Throwable $th) {
            DB::rollback();
            return $th;
        }

        Cache::forget('choose_' . $lang);

        return response()->json([
            'message' => __("Page Updated Successfully"),
            'redirect' => route('admin.page.index')
        ]);
    }

    public function edit($id)
    {
        $page_edit = Term::findOrFail($id);
        return view('admin.page.edit', compact('page_edit'));
    }

    public function about($lang)
    {
        $block1 = Term::where('type', 'about_block1')->with('description')->where('lang', $lang)->first();
        $block2 = Term::where('type', 'about_block2')->with('description')->where('lang', $lang)->first();

        $block1_meta = json_decode($block1->description->value ?? '');
        $block2_meta = json_decode($block2->description->value ?? '');

        return view('admin.page.about', compact('block1', 'block2', 'lang', 'block1_meta', 'block2_meta'));
    }

    public function update(Request $request, $id)
    {
        // Validate
        $request->validate([
            'page_title' => 'required',
            'status' => 'required',
        ]);

        $page_logo_path = $page_logo_name = '';
        // page data update
        $page_update = Term::findOrFail($id);

        // Data
        $data = [
            'page_excerpt' => $request->page_excerpt,
            'page_content' => $request->page_content,
            'metatag' => $request->metatag,
            'metadescription' => $request->metadescription,
        ];
        $page_update->title = $request->page_title;
        $page_update->slug = Str::slug($request->page_title);
        $page_update->type = 'page';
        $page_update->status = $request->status;
        $page_update->featured = 1;
        $page_update->save();

        // page Meta data store
        $page_meta_update = TermMeta::where('term_id', $id)->first();
        $page_meta_update->value = json_encode($data);
        $page_meta_update->save();

        Cache::forget('page_' . $page_update->slug);

        return response()->json([
            'message' => __("Page Updated Successfully"),
            'redirect' => route('admin.page.index')
        ]);
    }

    public function destroy(Term $page)
    {
        $page->delete();
        Cache::forget('page_' . $page->slug);

        return response()->json([
            'message' => __("Page Deleted Successfully"),
            'redirect' => route('admin.page.index')
        ]);
    }
    public function deleteAll(Request $request){
        if (empty($request->ids)){
            return response()->json([
                'message' => __("Please select at least one item"),
            ],404);
        }

        Term::whereIn('id', $request->ids)->delete();

        return response()->json([
            'message' => __("Page Created Successfully"),
            'redirect' => route('admin.page.index')
        ]);
    }
}
