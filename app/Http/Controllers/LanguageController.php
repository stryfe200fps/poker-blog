<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class LanguageController extends Controller
{
    //
    public function setLocale($locale): RedirectResponse
    {

        session()->put('locale', $locale);
        Inertia::share('locale', $locale);

        return redirect()->back();
    }
}
