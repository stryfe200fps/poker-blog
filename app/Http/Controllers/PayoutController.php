<?php

namespace App\Http\Controllers;

use App\Models\EventPayout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{

    public function player($player_id, $event)
    {
       $payout = EventPayout::where('player_id', $player_id)->where('event_id', $event)->firstOrFail();
        return $payout?->prize ?? '';
    }
}
