<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Event;
class EventController extends Controller
{
    public function show($slug, $page = null)
    {

    $webPage = \JsonLd\Context::create('web_page', [
        'description' => 'Home page',
        'url' => config('app.url'). '/event',
    ]);

    $event = Event::where('slug', $slug)->first();

    return Inertia::render('Event/Index', [
        'slug' => $slug,
        'page' => $page ?? 'reports',
        'title' => $event->tournament->title .' | '. $event->title .' | LifeOfPoker' ,
        'description' => $event->tournament->description,
        'json-ld-webpage' => $webPage,
    ]);

    }

}