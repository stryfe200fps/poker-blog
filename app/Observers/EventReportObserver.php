<?php

namespace App\Observers;

use App\Events\NewReport;
use App\Models\EventChip;
use App\Models\EventPayout;

class EventReportObserver
{
    public $afterCommit = true;

    public function created($model)
    {
        NewReport::dispatch($model->event->slug, $model->day_id);
    }

    public function saved($model)
    {
        if (is_array($model->eventChipPlayers->toArray())) {
            $model->event_chips()->delete();
            foreach (request()->get('eventChipPlayers') ?? [] as $eventChipPlayer) {
                $event = EventChip::create([
                    'name' => '',
                    'event_report_id' => $model->id,
                    'day_id' => $model->day_id,
                    'published_date' => $model->published_date,
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


        public function creating ($model)  { 
            $date = \Carbon\Carbon::parse($model->published_date?->toDateTimeString(), session()->get('timezone') ?? 'UTC');
            $model->published_date = $date->setTimezone('UTC');

        } 

        public function deleting($model) {
            $model->event_chips()->delete();
        }
}
