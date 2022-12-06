<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use Auth;
use Cache;
class SitesettingsController extends Controller
{
   public function index()
   {
      
   }

   public function update(Request $request,$type)
   {
        request()->validate([
        'header_logo' => 'image|max:1000',
        'logo_dark' => 'image|max:1000',
        'favicon' => 'image|max:1000'

        ]);

        $settings=Option::where('key',$type)->first();
        if (empty($settings)) {
           $settings= new Option;
           $settings->key=$type;
        }
        $settings->value=json_encode($request->data);
        $settings->save();

        if ($request->hasFile('favicon')) {
            $favicon=$request->favicon;
            $favicon->move('uploads/', 'favicon.ico'); 
            
        }

        if ($request->hasFile('header_logo')) {
            $logo=$request->header_logo;
            $logo->move('uploads/', 'logo.png'); 
            
        }

        if ($request->hasFile('footer_logo')) {
            $logo_dark=$request->footer_logo;
            $logo_dark->move('uploads/', 'logo_dark.png'); 
            
        }
        
        Cache::forget($type);
        return response()->json('Settings Updated Successfully...!!');
        
   }
}
