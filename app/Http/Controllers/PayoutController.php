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
<<<<<<< HEAD
        return EventPayoutResource::collection(EventPayout::orderBy('position', 'asc')->where('event_id', Event::where('slug', $slug)->first()->id)->paginate(100));
=======
        return EventPayoutResource::collection(EventPayout::orderBy('position', 'asc')->where('event_id', Event::where('slug', $slug)->first()->id)->paginate(20));
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }
}
