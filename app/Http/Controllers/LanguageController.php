<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request , $locale)
    {
        session()->put('locale', $locale);
        app()->setLocale($locale);
        return back();
    }
}
