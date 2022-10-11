<?php

namespace App\Http\Controllers;

use App\Models\EventPayout;
use Exception;

class PayoutController extends Controller
{
    public function player($player_id, $event)
    {
        try {
            $payout = EventPayout::where('player_id', $player_id)->where('event_id', $event)->firstOrFail();

            return $payout?->prize ?? '';
        } catch (Exception $e) {
            return '';
        }
    }
}
