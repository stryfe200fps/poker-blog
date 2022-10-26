<?php

namespace App\Observers;

use App\Events\NewReport;
use App\Models\EventChip;
use App\Models\EventPayout;
use Illuminate\Support\Facades\DB;

class EventReportObserver
{
    
    public function created($model) {
        NewReport::dispatch($model->slug, $model->day_id);
    }

    public function saved($model) {
            if (is_array($model->eventChipPlayers->toArray()) ) {

                $model->event_chips()->delete();
                foreach (request()->get('eventChipPlayers') ?? [] as $eventChipPlayer) {
                      $event =   EventChip::create([
                        'name' => '',
                        'event_report_id' => $model->id,
                        'day_id' => $model->day_id,
                        'date_published' => $model->date_added,
                        'player_id' => $eventChipPlayer['player_id'],
                        'current_chips' => $eventChipPlayer['current_chips'],
                    ]);

                    if ($eventChipPlayer['payout'] ?? null !== null) {
                        if (EventPayout::where('event_id', $model->event_id)->where('player_id', $eventChipPlayer['player_id'])->count() > 0) {
                            $eventPayout = EventPayout::where('event_id', $model->event_id)->where('player_id', $eventChipPlayer['player_id'])->firstOrFail();
                            $eventPayout->prize = $eventChipPlayer['payout'];
                            $eventPayout->position = $eventChipPlayer['position'];
                            $eventPayout->save();
                        } else {
                            EventPayout::create([
                                'player_id' => $eventChipPlayer['player_id'], 'event_id' => $model->event_id,
                                'prize' => $eventChipPlayer['payout'],
                            ]);

                        }
                    }
                }
            } 

        }
}
