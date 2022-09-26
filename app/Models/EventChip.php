<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventChip extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

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
        'event_id',
        'event_report_id',
        'chips_before',
        'rank',
        'event_payout_id'
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

        if ($this->attributes['event_report_id'] === null)
            return;

        $q = $this-> 
        where('event_id', $this->event_id)
        ->whereNotNull('event_report_id');

        $q->where('player_id', $this->player_id);

        return $q->where('event_report_id', '<', $this->event_report_id)->orderBy('id', 'desc')->first()->current_chips ?? 0;
    }

    protected static function booted()
    {
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
                        // dump($players);
                        unset($players[$key]);
                        // $report->players->unset($key);
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
