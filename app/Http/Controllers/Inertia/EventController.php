<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Event;
class EventController extends Controller
{
    // public function show($tour, $series, $eventSlug, $type = null, $day = null )
    public function show($eventSlug, $page = null )
    {

    $webPage = \JsonLd\Context::create('web_page', [
        'description' => 'Home page',
        'url' => config('app.url'). '/event',
    ]);


    $event = Event::where('slug', $eventSlug)->firstOrFail();

    // if ($tour != $event->tournament->tour->slug || $series != $event->tournament->slug    ) {
    //     return redirect('/tours/'. $event->tournament->tour->slug . '/'. $event->tournament->slug  . '/'. $eventSlug );
    // } 



    return Inertia::render('Event/Index', [
        'slug' => $eventSlug,
        'page' => $page ?? 'reports',
        // 'day' => $day ?? '',
        // 'type' => $type ?? '',
        'title' => $event->tournament->title .' | '. $event->title .' | LifeOfPoker' ,
        'description' => $event->tournament->description,
        'json-ld-webpage' => $webPage,
    ]);

    }


}