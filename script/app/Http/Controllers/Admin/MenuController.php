<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use DB;
use Cache;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menus-create')->only('create', 'store');
        $this->middleware('permission:menus-read')->only('index', 'show');
        $this->middleware('permission:menus-update')->only('edit', 'update');
        $this->middleware('permission:menus-delete')->only('edit', 'destroy');
    }

    public function index()
    {
        $menus = Menu::latest()->get();
        $langs = get_option('languages',true);

        return view('admin.menu.create', compact('menus', 'langs'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->status == 1) {
            if ($request->position == 'header') {
                DB::table('menus')->where('position', $request->position)->where('lang', $request->lang)->update(['status' => 0]);
            }
        }
        $men = new Menu;
        $men->name = $request->name;
        $men->position = $request->position;
        $men->status = $request->status;
        $men->lang = $request->lang;
        $men->data = "[]";
        $men->save();

        Cache::forget('website.home.'.current_locale());

        return response()->json(['Menu Created']);
    }

    public function show(Menu $menu)
    {
        return view('admin.menu.index', compact('menu'));
    }

    /**
     * update menus json row in  menus table
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function MenuNodeStore(Request $request)
    {
        $info = Menu::find($request->menu_id);
        $info->data = $request->data;
        $info->save();
        Cache::forget($info->position . $info->lang);
        Cache::forget('website.home.'.current_locale());
        return response()->json(['Menu Updated']);
    }

    public function edit($id)
    {
        $info = Menu::findOrFail($id);
        $langs = get_option('languages',true);
        return view('admin.menu.edit', compact('info', 'langs'));
    }

    public function update(Request $request, $id)
    {
        if ($request->status == 1) {
            if ($request->position == 'header') {
                DB::table('menus')->where('position', $request->position)->where('lang', $request->lang)->update(['status' => 0]);
            }
        }

        $men = Menu::find($id);
        $men->name = $request->name;
        $men->position = $request->position;
        $men->status = $request->status;
        $men->lang = $request->lang;
        $men->save();
        Cache::forget($request->position . $request->lang);
        Cache::forget('website.home.'.current_locale());
        return response()->json(['Menu Updated']);
    }

    public function destroy(Request $request)
    {
        if ($request->input('method') == 'delete') {
            if ($request->ids) {
                foreach ($request->ids as $id) {
                    Menu::destroy($id);
                }
            }
        }

        Cache::forget('website.home.'.current_locale());

        return response()->json(['Menu Removed']);
    }
}
