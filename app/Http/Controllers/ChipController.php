<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\EventChipsResource;
use App\Http\Resources\LOFApiEventIndexChipCountResource;

class ChipController extends Controller
{
    //
    public function event($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        
        return collect(EventChipsResource::collection($event->latest_event_chips()));

        // return collect(EventChipsResource::collection($event->latest_event_chips->sortByDesc('date_published')
        //  ->unique('player_id')))->sortByDesc('current_chips')->values()->all();

    }
}
