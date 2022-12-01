<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Day;
use Spatie\Image\Image;
use App\Traits\ImageUpload;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use App\Traits\BackpackSlugify;
use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasMediaCollection;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use App\Traits\RecordMedia;
use App\Traits\RecordSlug;
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
    public bool $shouldResizeImage = true;

    protected $guarded = ['id'];

    public $mediaCollection = 'event';
    use HasMediaCollection, HasMultipleImages;
    use RecordSlug, RecordMedia;



    public function getScheduleAttribute()
    {
        $schedule = $this->load('days')->getSchedule()->toArray() ?? [];

        if (!count($schedule))
            return 'TBA';

        $newSched = [
            'date_start' => Carbon::parse(Day::find(array_key_first($schedule))->date_start, 'UTC')
                ->setTimezone(session()->get('timezone'))->toDateTimeString(),

            'date_end' => Carbon::parse(Day::find(array_key_last($schedule))->date_end, 'UTC')
                ->setTimezone(session()->get('timezone'))->toDateTimeString(),
        ];

        return $newSched;
    }


    public function daysStatus()
    {
        return $this->days->map->status();
    }

    public function latestDay()
    {
        return $this->hasOne(Day::class)->orderBy('date_start', 'DESC');
    }

    // This getLiveEvents  will be called statically on the homepage where there's 2 live event showing
    public static function getLiveEvents()
    {
        $date = Carbon::now()->toDateTime();

        $query = self::where('is_live', true)->whereHas(
            'days',
            fn ($q) => $q->whereDate('date_start', '<=', $date)
                ->whereDate('date_end', '>=',  $date)
        );

        return $query;
    }

    public function getCurrentLiveEvent()
    {
        $date = Carbon::now()->toDateTime();
        return $this->where('id', $this->id)->whereHas(
            'days',
            fn ($q) => $q->whereDate('date_start', '<=', $date)
                ->whereDate('date_end', '>=',  $date)
        );
    }

    public function scopeShowLatest($query)
    {

        $date = Carbon::now()->toDateTime();

        return $query->addSelect([
            'last_date_start' => Day::select('date_start')->whereColumn('event_id', 'events.id')
                ->whereDate('date_start', '<=', $date)
                ->whereDate('date_end', '>=',  $date)
                ->orderBy('date_start', 'desc')->limit(1),
        ])->orderByDesc('last_date_start');

        return $query;
    }

    public function status()
    {

        $statuses = $this->daysStatus()->toArray() ?? [];

        if (!count($statuses))
            return 'upcoming';

        //ouput 'live' from start of day and end of day
        if ($this->getCurrentLiveEvent()->count())
            return 'live';

        if (in_array('live', $statuses))
            return 'live';

        return in_array('upcoming', $statuses) ? 'upcoming' : 'end';
    }

    public function getSchedule()
    {
        return $this->days()->orderBy('lft')->pluck('name', 'id');
    }

    public function getScheduleWithReports()
    {
        return $this->days()->orderBy('lft')
            ->whereHas('event_reports')
            ->get()->map->only('id', 'name');
    }

    public function getLastSchedule()
    {
        return $this->days()->orderByDesc('lft')
            ->whereHas('event_reports')
            ->first();
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
        return $this->poker_tournament()->first()->title . ' > ' . $this->title;
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
        return '<a class="btn btn-sm btn-link"  href="report?event=' . urlencode($this->attributes['id']) . '" data-toggle="tooltip" title="Live reporting"><i class="fa fa-search"></i> Reports  </a>';
    }

    public function openPayout($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="payout?event=' . urlencode($this->attributes['id']) . '" data-toggle="tooltip" title="Live reporting"><i class="fa fa-search"></i> Payouts  </a>';
    }

    public function openChipCount($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="chip-count?event=' . urlencode($this->attributes['id']) . '" data-toggle="tooltip" title="Chip Counts"><i class="fa fa-search"></i> Chips  </a>';
    }

    public function openDay($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="day?event=' . urlencode($this->attributes['id']) . '" data-toggle="tooltip" title="Days"><i class="fa fa-search"></i> Days  </a>';
    }

    public function openLevel($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="level?event=' . urlencode($this->attributes['id']) . '" data-toggle="tooltip" title="Days"><i class="fa fa-search"></i> Levels  </a>';
    }
}
