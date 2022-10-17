<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function show($slug, $page = null)
    {

    $webPage = \JsonLd\Context::create('web_page', [
        'description' => 'Home page',
        'url' => config('app.url'). '/event',
    ]);

    return Inertia::render('Event/Index', [
        'slug' => $slug,
        'page' => $page ?? 'reports',
        'title' => 'Life of poker',
        'description' => 'life of poker',
        'json-ld-webpage' => $webPage,
    ]);

    }

}