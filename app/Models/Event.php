<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;

    protected $guarded = ['id'];

    protected $casts = [
        'schedule' => 'json'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function currentDay() {
        $dateNow = Carbon::now();
        foreach ( json_decode($this->attributes['schedule'], true) ?? [] as $sched) {
            if ( $dateNow >= Carbon::parse($sched['date_start'])  && $dateNow <= Carbon::parse($sched['date_end'])) {
                // dd(Carbon::parse($sched['date_start']));
                return $sched['day'];
            }
        }

        return 0;
    }

    public function eventSchedules() {

        return collect()->pluck('day', 'day');
    }

    public function getSlugAttribute($value)
    {
        return $value;
    }

    public function setSlugAttribute($value)
    {
        if ($value !== null) {
            $this->attributes['slug'] = $value;
        }
    }
    // use HasSlug;

    // public function getSlugOptions(): SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom('title')
    //         ->saveSlugsTo('slug');
    // }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main-image')
            ->width(424)
            ->height(285);

        $this->addMediaConversion('main-thumb')
            ->width(337)
            ->height(225);

        $this->addMediaConversion('main-gallery-thumb')
                ->width(130)
                ->height(86);
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('event', 'main-image');
    }

    public function setImageAttribute($value)
    {
        if ($value == null || preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            // $this->media()->delete();
            $this->media()->delete();
            return false;
        }
        $this->media()->delete();
        $this->addMediaFromBase64($value)
            ->toMediaCollection('event');
    }

    public function getParentAttribute($value)
    {
        return $this->poker_tournament()->first()->title.' > '.$this->title;
    }

    public function live_report_players()
    {
        return $this->hasMany(EventChip::class);
    }

    public function latest_event_chips()
    {
        return $this->hasMany(EventChip::class)->orderByDesc('created_at');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function event_reports()
    {
        return $this->hasMany(EventReport::class);
    }

    public function event_payouts()
    {
        return $this->hasMany(EventPayout::class)->orderBy('position');
    }

    public function getAvailableDays()
    {
        $days = collect(EventReport::where('event_id', $this->id)->get()->groupBy('day')->toArray())->map(function ($item) {
            return $item[0]['day'];
        });

        return $days;
    }

    public function openLiveReporting($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="report?event='.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Live reporting"><i class="fa fa-search"></i> Reports  </a>';
    }

    public function openPayout($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="payout?event='.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Live reporting"><i class="fa fa-search"></i> Payouts  </a>';
    }

    public function openChipCount($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="chip-count?event='.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Chip  Count"><i class="fa fa-search"></i> Chip Counts  </a>';
    }
}
