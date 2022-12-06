<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLanguage($locale)
    {
        $languages = get_option('languages');
        if (isset($languages[$locale])){
            Session::put('locale', $locale);
        }else {
            abort(404, __('Language Not Found'));
        }

        return redirect()->back();
    }
}
