<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\GroupedLastScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'date_published',
        'event_payout_id',
        'event_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function event_reports()
    {
        return $this->belongsToMany(EventReport::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getPreviousReportAttribute($value)
    {

        $q = $this->where('player_id', $this->player_id);
        $q->where('event_id', $this->event_id);

        return $q->where('id', '!=', $this->id)->where('date_published', '<' , $this->date_published)->orderBy('date_published', 'desc')->first()->current_chips ?? 0;

    }

    public function setDatePublishedAttribute($value) 
    {
        $this->attributes['date_published'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    }

    public function getDatePublishedAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
    }

    protected static function booted()
    {
        static::creating(function ($createdChipCount) {

            if ($createdChipCount?->event_report_id !== null) {
                \Alert::add('success', 'Player added');
            } else {
               $eventChip = EventChip::where('player_id', $createdChipCount->player_id )->whereNull('event_report_id')->where('event_id', $createdChipCount->event_id);
               if ($eventChip->count()) {
                \Alert::add('error', 'Oops. This player is already added');
                return false;
            }
            }

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
