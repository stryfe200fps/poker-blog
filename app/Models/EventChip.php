<?php

namespace App\Models;

use App\Traits\GroupedLastScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventChip extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use GroupedLastScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chips',
        'name',
        'current_chips',
        'player_id',
        'event_report_id',
        'chips_before',
        'is_whatsapp',
        'rank',
        'published_date',
        'day_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function event_report()
    {
        return $this->belongsTo(EventReport::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getIsWhatsappAttribute($value)
    {
        return (int) $value;
    }

    public function getPreviousReportAttribute($value)
    {
        $q = $this->where('player_id', $this->player_id);
        $q->where('day_id', $this->day_id);

        return $q->where('event_chips.id', '!=', $this->id)
            ->where('event_chips.published_date', '<', $this->published_date)
            ->orderBy('event_chips.published_date', 'desc')
            ->first()->current_chips ?? 0;
    }

    public function setPublishedDateAttribute($value)
    {
        $this->attributes['published_date'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    }

    public function getPublishedDateAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
    }

    protected static function booted()
    {
        static::creating(function ($createdChipCount) {
            if ($createdChipCount?->event_report_id !== null) {
                \Alert::add('success', 'Player added');
            } 
            // else {
            //     $eventChip = EventChip::where('player_id', $createdChipCount->player_id)->whereNull('event_report_id')->where('day_id', $createdChipCount->day_id);
            //     if ($eventChip->count()) {
            //         \Alert::add('error', 'Oops. This player is already added');

            //         return false;
            //     }
            // }

            \Alert::add('success', 'Success');
        });

        static::deleting(function ($deletedEventChip) {
            $reportId = $deletedEventChip->event_report_id;

            $reports = EventReport::where('id', $reportId)->get();

            foreach ($reports as $report) {
                $players = $report->players;
                foreach ($report->players as $key => $player) {
                    // dd($player['player_id'], $deletedEventChip->player_id, $player['player_id'] == $deletedEventChip->player_id);
                    if ($player['player_id'] == $deletedEventChip->player_id) {
                        //  $whoami =   Player::where( 'id', $player['player_id'])->first();
                        //  dump($whoami);
                        unset($players[$key]);
                        // dump('----');
                        // dd($players);
                    }
                }
                $reportModel = EventReport::where('id', $report->id)->first();
                $reportModel->players = $players;
                $reportModel->save();
            }
        });
    }
}
