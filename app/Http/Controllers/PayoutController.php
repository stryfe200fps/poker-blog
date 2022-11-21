<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventPayoutResource;
use App\Models\Event;
use App\Models\EventPayout;
use Exception;

class PayoutController extends Controller
{
    public function player($player_id, $event)
    {
        try {
            $payout = EventPayout::where('player_id', $player_id)->where('event_id', $event)->firstOrFail();
            return $payout ?? '';
        } catch (Exception $e) {
            return '';
        }
    }

    public function event_payout($slug)
    {
        return EventPayoutResource::collection(EventPayout::orderBy('position', 'asc')->where('event_id', Event::where('slug', $slug)->first()->id)->paginate(100));
    }
}
