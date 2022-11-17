<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventChipsResource;
use App\Models\Day;

class ChipController extends Controller
{
    //
    public function event_chip($id)
    {
        $day = Day::with(['event_chips'])->find($id);
        return EventChipsResource::collection($day->latest_event_chips());
    }

    public function whatsapp($id)
    {
        $day = Day::with(['event_chips'])->find($id);
        return EventChipsResource::collection($day->whatsapp_event_chips());
    }
}
