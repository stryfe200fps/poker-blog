<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventPayoutResource;
use Exception;
use App\Models\Event;
use App\Models\EventPayout;

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
        return EventPayoutResource::collection(EventPayout::where('event_id', Event::where('slug',$slug)->first()->id )->paginate(20));
    }
}
