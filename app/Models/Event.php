<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Day;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class Event extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use InteractsWithMedia;
    // use ImageOptimizer;
    use HasSlug;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = ['id'];

    // protected $casts = [
    //     'schedule' => 'json',
    // ];

    // public function setScheduleAttribute($schedule)
    // {
    //     $this->attributes['schedule'] = $this->scheduleArray($schedule);
    // }

    public function getScheduleAttribute()
    {
        $schedule = $this->load('days')->getSchedule()->toArray() ?? [];

        if (!count($schedule))
            return 'TBA';

        $newSched = [
            'date_start' => Carbon::parse( Day::find(array_key_first($schedule))->date_start, 'UTC' )
                ->setTimezone(session()->get('timezone'))->toDateTimeString(),

            'date_end' => Carbon::parse(Day::find(array_key_last($schedule))->date_end, 'UTC')
                ->setTimezone(session()->get('timezone'))->toDateTimeString(),
        ];

        return $newSched;
    }
    

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }


    public function status()
    {
        $dateNow = Carbon::now();

        $schedule = $this->load(['days'])->days->toArray() ?? [];

        if (count($schedule) === 0) {
            return 'upcoming';
        }

        foreach ($schedule as $sched) {
            if ($dateNow >= Carbon::parse($sched['date_start']) && $dateNow <= Carbon::parse($sched['date_end'])) {
                return 'live';
            }
        }

        if (Carbon::parse($schedule[0]['date_start']) > $dateNow) {
            return 'upcoming';
        }

        if (Carbon::parse($schedule[count($schedule) - 1]['date_end']) < $dateNow) {
            return 'end';
        }
    }

    public function getSchedule()
    {
        $sched = $this->days->filter(function ($item) {
            return $item->report_count();
        })->sortBy('lft')->pluck('name', 'id');

        return $sched;
    }

    public function days()
    {
        return $this->hasMany(Day::class);
    }

    public function descendingDays()
    {
        return $this->hasMany(Day::class)->orderByDesc('lft');
    }

    public function eventSchedules()
    {
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

    public function registerMediaConversions(?Media $media = null): void
    {

        $this->addMediaConversion('big-image')
            ->width(1200)
            ->height(630)
            ->nonQueued();

        $this->addMediaConversion('main-image')
            ->width(424)
            ->height(285)
            ->nonQueued(); 

        $this->addMediaConversion('main-thumb')
            ->width(337)
            ->height(225)
            ->nonQueued();

        $this->addMediaConversion('main-gallery-thumb')
            ->width(130)
            ->height(86)
            ->nonQueued();

        $this->addMediaConversion('main-gallery');
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('event', 'main-image');
    }

    public function setImageAttribute($value)
    {
        if ($value == null) {
            $this->media()->delete();
        }

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            return false;
        }

        $this->media()->delete();
        $this->addMediaFromBase64($value)
            ->toMediaCollection('event');
    }

    public function event_game_table()
    {
        return $this->belongsTo(EventGameTable::class);
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
        $reduced = collect($this->descendingDays()->get())->map(function ($day) {
            return $day->event_chips()->orderBy('published_date', 'DESC')->get();
        });
        // return $reduced->flatten()->sortByDesc('published_date')->unique('player_id')->sortByDesc('current_chips');
        return $reduced->flatten()->unique('player_id')->sortByDesc('current_chips');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function tour()
    {
        return $this->belongsToThrough(Tour::class, Tournament::class);
    }

    public function event_reports()
    {
        return $this->hasManyThrough(EventReport::class, Day::class);
    }

    public function event_payouts()
    {
        return $this->hasMany(EventPayout::class)->orderBy('position');
    }

    public function getAvailableDays()
    {
        $dateNow = Carbon::now();
        $schedule = $this->attributes['schedule'];

        $days = [];
        foreach (collect(json_decode($schedule, true))->toArray() as $sched) {
            if ($dateNow >= Carbon::parse($sched['date_start'])) {
                $days[] = ['day' => $sched['day']];
            }
        }

        return collect($days)->pluck('day', 'day');
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
        return '<a class="btn btn-sm btn-link"  href="chip-count?event='.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Chip Counts"><i class="fa fa-search"></i> Chips  </a>';
    }

    public function openDay($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="day?event='.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Days"><i class="fa fa-search"></i> Days  </a>';
    }

    public function openLevel($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="level?event='.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Days"><i class="fa fa-search"></i> Levels  </a>';
    }

    // public function setDateStartAttribute($value)
    // {
    //     $this->attributes['date_start'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    // }

    // public function getDateStartAttribute($value)
    // {
    //     return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
    // }

    // public function setDateEndAttribute($value)
    // {
    //     $this->attributes['date_end'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    // }

    // public function getDateEndAttribute($value)
    // {
    //     return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
    // }

    protected static function booted()
    {
        static::creating(function ($model) {
            if ($model->slug == '') {
                return;
            }

            $model->slug = Str::slug($model->slug);
        });

        static::updating(function ($model) {

            $findModel = Event::find($model->id);
             if ($model->slug !== $findModel->slug) {
                $model->slug = Str::slug($model->slug);
            } 
        });

        static::saved(function ($model) {
            // $media = $model->media()->get()[0]->getPath();

            // dd($media);

        //  $t=   pathinfo($model->media()->getFirstMediaPath(), PATHINFO_DIRNAME);
        //     dd($t);
        });
    }
}
