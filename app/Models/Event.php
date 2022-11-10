<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Day;
use Spatie\Image\Image;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use App\Traits\BackpackSlugify;
use App\Traits\LOPDefaultTrait;
use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasMediaCollection;
use App\Observers\DefaultModelObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\ImageOptimizer\OptimizerChain;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ImageOptimizer\Optimizers\Optipng;
use Spatie\ImageOptimizer\Optimizers\Pngquant;
use Spatie\ImageOptimizer\Optimizers\Jpegoptim;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class Event extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    public $shouldOptimize = false;

    protected $guarded = ['id'];

    public $mediaCollection = 'event';
    use HasMediaCollection, HasMultipleImages;


    public static function boot()
    {
        parent::boot();
        self::observe(new DefaultModelObserver);
    }


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

    // public function scopeCurrentStatus($query)
    // {

    // }
    public function daysStatus()
    {
        return $this->days->map->status();
    }

    public function latestDay()
    {
        return $this->hasOne(Day::class)->orderBy('date_start', 'DESC');
    }

    public static function getLiveEvents()
    {
        $date = Carbon::now()->toDateTime();

        return self::orWhereHas('days', 
        fn ($q) => $q->whereDate('date_start', '<=' , $date )
            ->whereDate('date_end', '>=' ,  $date)
        );
    }

    public function scopeShowLatest($query) {
        $date = Carbon::now()->toDateTime();

      return $query->addSelect([
        'last_date_start' => Day::select('date_start')->whereColumn('event_id', 'events.id')
            ->whereDate('date_start', '<=' , $date )
            ->whereDate('date_end', '>=' ,  $date)
            ->orderBy('date_start', 'desc')->limit(1),
      ])->orderByDesc('last_date_start');
    }

    public function status()
    {


        $statuses = $this->daysStatus()->toArray() ?? [];

        if (in_array('live', $statuses))
            return 'live';
        
        return  in_array('upcoming', $statuses) ? 'upcoming' : 'end';
        

        // $nice = Event::first()->eventFunc();

        // $dateNow = Carbon::now();

        // $schedule = $this->load(['days'])->days->toArray() ?? [];

        // if (count($schedule) === 0) {
        //     return 'upcoming';
        // }

        // foreach ($schedule as $sched) {
        //     if ($dateNow >= Carbon::parse($sched['date_start']) && $dateNow <= Carbon::parse($sched['date_end'])) {
        //         return 'live';
        //     }
        // }

        // if (Carbon::parse($schedule[0]['date_start']) > $dateNow) {
        //     return 'upcoming';
        // }

        // if (Carbon::parse($schedule[count($schedule) - 1]['date_end']) < $dateNow) {
        //     return 'end';
        // }
    }

    public function getSchedule()
    {
        return $this->days()->orderByDesc('lft')->withCount('event_reports')
            ->having('event_reports_count', '>', 0 )->pluck('name', 'id');
    }

    public function getLastSchedule() 
    {
        return $this->days()->orderByDesc('lft')->withCount('event_reports')
            ->having('event_reports_count', '>', 0 )->first();
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


}
