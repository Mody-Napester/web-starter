<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    // Set Site Language
    public function setLanguage($language){
        $langArray = ['ar','en'];
        if (in_array($language, $langArray)) {
            session()->put('language', $language);
        }
        return redirect()->back();
    }
}
