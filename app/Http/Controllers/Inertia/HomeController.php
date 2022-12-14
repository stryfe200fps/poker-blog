<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $webPage = \JsonLd\Context::create('web_page', [
            'description' => 'Home page',
            'url' => config('app.url'),
        ]);

        return Inertia::render('Index', [
            'title' => 'LifeOfPoker',
            'json-ld-webpage' => $webPage,
        ]);
    }
}
