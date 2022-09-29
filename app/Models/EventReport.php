<?php

namespace App\Models;

use App\Events\EventReportCreated;
use Exception;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\SlugOptions;

class EventReport extends Model implements HasMedia
{
    use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main-thumb')
            ->width(300)
            ->height(300);

        $this->addMediaConversion('main-image')
            ->width(424)
            ->height(285);
    }



    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {

        return $this->getFirstMediaUrl('event-report', 'main-image');
    }

    public function setImageAttribute($value)
    {
        if ($value == null || preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            $this->media()->delete();
            return false;
        }
        $this->media()->delete();
        $this->addMediaFromBase64($value)
            ->toMediaCollection('event-report');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function event_chips()
    {
        return $this->hasMany(EventChip::class)->orderByDesc('current_chips');
    }

    public function live_report_players()
    {
        return $this->belongsToMany(EventChip::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function article_author()
    {
        return $this->belongsTo(ArticleAuthor::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public static function lastLevel()
    {
        return Level::where('event_id', session()->get('event_id') )->orderByDesc('created_at')->first();
    }

    public function shareToSocialMedia()
    {
        return '<a class="btn btn-sm btn-link"  href="https://facebook.com" data-toggle="tooltip" title="Share to facebook"><i class="la la-facebook"></i>    </a>';
    }

    protected $casts = [
        'players' => 'json',
    ];

    public function setPlayersAttribute($value)
    {
        if (isset($this->attributes['id'])) {
            if (is_array($value) && count($value) > 0) {
                $this->event_chips()->delete();
                $jsonObj = [];
                foreach ($value as $eventChipPlayer) {
                    $savedEventChip = EventChip::create([
                        'name' => '',
                        'event_report_id' => $this->attributes['id'],
                        'event_id' => $this->attributes['event_id'],
                        'player_id' => $eventChipPlayer['player_id'],
                        'current_chips' => $eventChipPlayer['current_chips'],
                    ]);

                    $jsonObj[] = $savedEventChip->toArray();


                    // if (!$checkIfHasPayout->count() ) {

                    //  $createdEvent =   EventPayout::create([
                    //         'name' =>  Player::find($eventChipPlayer['player_id'])->name,
                    //         'prize' => $eventChipPlayer['payout'],
                    //         'position' => $eventChipPlayer['rank'],
                    //         'player_id' => $eventChipPlayer['player_id'],
                    //         'event_report_id' => $this->attributes['id'],
                    //         'event_id' => $this->attributes['event_id']
                    //     ]);

                    // $savedEventChip->event_payout_id = $createdEvent->id;
                    // $savedEventChip->save();

                    // } else {
                    //     $payout = $checkIfHasPayout->first();
                    //     // dd($payout);
                    //     $payout->prize = $eventChipPlayer['payout'];
                    //     $payout->position = $eventChipPlayer['rank'];
                    //     $savedEventChip->event_payout_id = $payout->id;
                    //     $saved = $payout->save();
                    // }
                }

                $this->attributes['players'] = json_encode($jsonObj);
            } else {
                $this->event_chips()->delete();
                $this->attributes['players'] = json_encode([]);
            }
        } else {
            $this->attributes['players'] = json_encode($value);
        }
    }

    // public function getPlayersAttribute($value)
    // {

    //     return $value;
    //     // if ($this->event_chips()->count()) {
    //     //     $val = EventChip::with(['event_reports'])->whereHas('event_reports', function ($query) {
    //     //         $query->where('event_report_id', $this->id);
    //     //     })->get(['player_id', 'current_chips', 'payout', 'rank']);
    //     //     dd($val);
    //     //     return json_encode($val->toArray());
    //     // } else {
    //     //     return $value;
    //     // }
    // }

    protected static function booted()
    {
        static::deleting(function ($deletedReport) {
            $deletedReport->event_chips()->delete();
        });

        static::updated(function ($updatedEvent) {

            // dd($updatedEvent);

        });

        static::created(function ($createdEventReport) {
            $eventChipsPlayer = $createdEventReport->players;

            if (is_countable($eventChipsPlayer)) {
                foreach ($eventChipsPlayer as $eventChipPlayer) {

                    if ($eventChipPlayer['player_id'] === null)
                        continue;

                    EventChip::create([
                        'name' => 'name',
                        'event_report_id' => $createdEventReport->id,
                        'event_id' => $createdEventReport->event_id,
                        'player_id' => $eventChipPlayer['player_id'],
                        'current_chips' => $eventChipPlayer['current_chips'],
                    ]);

                    // $checkIfHasPayout = EventPayout::
                    // where('event_id', $createdEventReport->event_id)
                    // ->where('player_id',$eventChipPlayer->player_id );

                    // if ( $eventChipPlayer->payout === null) {
                    //     continue;
                    // }

                    // if (!$checkIfHasPayout->count() ) {
                    //  $createdEvent =   EventPayout::create([
                    //         'name' =>  Player::find($eventChipPlayer->player_id)->name,
                    //         'prize' => $eventChipPlayer->payout,
                    //         'position' => $eventChipPlayer->rank,
                    //         'player_id' => $eventChipPlayer->player_id,
                    //         'event_id' => $createdEventReport->event_id,
                    //         'event_report_id' => $createdEventReport->id,
                    //     ]);

                    // $savedEventChip->event_payout_id = $createdEvent->id;
                    // $savedEventChip->save();
                    // } else {
                    //     $payout = $checkIfHasPayout->first();
                    //     $payout->prize = $eventChipPlayer->payout;
                    //     $payout->position = $eventChipPlayer->rank;
                    //     $savedEventChip->event_payout_id = $payout->id;
                    //     $payout->save();
                    // }

                }
            }
        });

        // static::updating(function ($updatedEventReport) {

        //         $eventChipsPlayer = json_decode($updatedEventReport->players );

        //     if (is_countable($eventChipsPlayer)) {
        //         foreach ($eventChipsPlayer as $eventChipPlayer) {

        //             if ($eventChipPlayer->player_id === null)
        //                 continue;

        //             EventChip::create([
        //                 'name' => 'name',
        //                 'event_report_id' => $updatedEventReport->id,
        //                 'event_id' => $updatedEventReport->event_id,
        //                 'player_id' => $eventChipPlayer->player_id,
        //                 'current_chips' => $eventChipPlayer->current_chips,
        //             ]);


        //             // $checkIfHasPayout = EventPayout::
        //             // where('event_id', $createdEventReport->event_id)
        //             // ->where('player_id',$eventChipPlayer->player_id );

        //             // if ( $eventChipPlayer->payout === null) {
        //             //     continue;
        //             // }

        //             // if (!$checkIfHasPayout->count() ) {

        //             //  $createdEvent =   EventPayout::create([
        //             //         'name' =>  Player::find($eventChipPlayer->player_id)->name,
        //             //         'prize' => $eventChipPlayer->payout,
        //             //         'position' => $eventChipPlayer->rank,
        //             //         'player_id' => $eventChipPlayer->player_id,
        //             //         'event_id' => $createdEventReport->event_id,
        //             //         'event_report_id' => $createdEventReport->id,
        //             //     ]);

        //             // $savedEventChip->event_payout_id = $createdEvent->id;
        //             // $savedEventChip->save();
        //             // } else {
        //             //     $payout = $checkIfHasPayout->first();
        //             //     $payout->prize = $eventChipPlayer->payout;
        //             //     $payout->position = $eventChipPlayer->rank;

        //             //     $savedEventChip->event_payout_id = $payout->id;
        //             //     $payout->save();
        //             // }


        //         }
        //     }

        // });
    }
}
