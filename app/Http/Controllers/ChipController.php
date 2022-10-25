<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\EventChipsResource;
use App\Http\Resources\LOFApiEventIndexChipCountResource;
use App\Models\Day;

class ChipController extends Controller
{
    //
    public function event_chip($id)
    {
        $day = Day::find($id);
        return collect(EventChipsResource::collection($day->latest_event_chips()));

    }

    public function whatsapp($id)
    {
        $day = Day::find($id);
        return collect(EventChipsResource::collection($day->whatsapp_event_chips()));
    }
}
