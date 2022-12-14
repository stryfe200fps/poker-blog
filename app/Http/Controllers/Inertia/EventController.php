<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Inertia\Inertia;

class EventController extends Controller
{
    public function show($tour, $series, $eventSlug, $day = null, $type = null )
    {
        if ($eventSlug === 'undefined' || $eventSlug === 'null') return;

        $webPage = \JsonLd\Context::create('web_page', [
            'url' => request()->url(),
        ]);

        $event = Event::where('slug', $eventSlug)->firstOrFail();
       
        // if ($tour != $event->tournament->tour->slug || $series != $event->tournament->slug) {
        // return redirect('/tours/'. $event->tournament->tour->slug . '/'. $event->tournament->slug  . '/'. $eventSlug );
        // }

        if ($event->getLastSchedule() === null)
            return redirect()->back();

        return Inertia::render('Event/Index', [
            'slug' => $eventSlug,
            'page' => $page ?? 'reports',
            'day' => $day == null && $type == null ?  $event->getLastSchedule()->name :  $day,
            'type' => in_array($day, ['whatsapp', 'chip-stack', 'gallery', 'payouts', 'live-updates']) ? $day : $type,
            'title' => $event->tournament->title.' | '.$event->title.' | LifeOfPoker',
            'description' => $event->description,
            'json-ld-webpage' => $type === 'payouts' ? \JsonLd\Context::create('web_page', [
                'url' => config('app.url'). '/tours/'. $event->tournament->tour->slug . '/'. $event->tournament->slug. '/'. $eventSlug . '/payouts',
            ]) :   $webPage,
            'url' => config('app.url')
        ]);
    }
}
