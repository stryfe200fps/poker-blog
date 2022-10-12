<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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
        'schedule' => 'json',
    ];

    protected $appends = [
        'event_date_start',
        'event_date_end',
    ];

    public function getEventDateStartAttribute()
    {
        return $this->scheduleArray($this->schedule)->first()['date_start'] ?? '';
    }

    public function getEventDateEndAttribute()
    {
        return $this->scheduleArray($this->schedule)->last()['date_end'] ?? '';
    }

    public function scheduleArray($schedule = [], $timezone = null)
    {
        if (is_string($schedule))
            $schedule = json_decode($schedule, true);

        if ($timezone == null)
            $timezone = session()->get('timezone');

        return collect($schedule)->map(function ($item) {
            $item['date_start'] = Carbon::parse($item['date_start'], $timezone ?? 'UTC')
            ->setTimezone('UTC')
            ->toDateTimeString();

            $item['date_end'] = Carbon::parse($item['date_end'], $timezone ?? 'UTC')
           ->setTimezone('UTC')
           ->toDateTimeString();

            return $item;
        });
    }

    public function setScheduleAttribute($schedule)
    {
        $this->attributes['schedule'] = $this->scheduleArray($schedule);
    }


    public function getScheduleAttribute($schedule)
    {
        $sched = json_decode($schedule, true);
        return $this->scheduleArray($sched);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function currentDay()
    {
        $dateNow = Carbon::now();
        foreach (json_decode($this->attributes['schedule'], true) ?? [] as $sched) {
            if ($dateNow >= Carbon::parse($sched['date_start']) && $dateNow <= Carbon::parse($sched['date_end'])) {
                return $sched['day'];
            }
        }

        return 0;
    }

    public function status()
    {
        $dateNow = Carbon::now();
        foreach (json_decode($this->attributes['schedule'], true) ?? [] as $sched) {
            if ($dateNow >= Carbon::parse($sched['date_start']) && $dateNow <= Carbon::parse($sched['date_end'])) {
                return 'live';
            } elseif ($dateNow <= Carbon::parse($sched['date_start'])->addDays(2)) {
                return 'upcoming';
            } else {
                return 'past';
            }
        }

        return 'tba';
    }

    public function currentDateSchedule()
    {
        $dateNow = Carbon::now();
        $schedules = json_decode($this->attributes['schedule'], true);

        if (! is_countable($schedules)) {
            return 'no schedule yet';
        }

        foreach ($schedules as $sched) {
            if ($dateNow >= Carbon::parse($sched['date_start']) && $dateNow <= Carbon::parse($sched['date_end'])) {
                return 'Day '.$sched['day'].'  :  '.Carbon::parse($sched['date_start'])->format('M j, Y, ga D').' to '.Carbon::parse($sched['date_end'])->format('M j, Y, ga D').'   -   '.Carbon::parse($sched['date_start'])->diffForHumans();
            }
        }

        //upcoming

        foreach ($schedules as $sched) {
            if ($dateNow < Carbon::parse($sched['date_start'])) {
                // date("F j, Y, g:i a");
                // $hora = Carbon::parse($sched['date_start'])->format('M j, Y, ga D');
                // dd($hora);
                return 'Day '.$sched['day'].'  :  '.Carbon::parse($sched['date_start'])->format('M j, Y, ga D').' to '.Carbon::parse($sched['date_end'])->format('M j, Y, ga D').'   -   '.Carbon::parse($sched['date_start'])->diffForHumans();
            }
        }

        return 'schedule ended '.Carbon::parse($schedules[count($schedules) - 1]['date_end'])->diffForHumans();
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

        $this->addMediaConversion('main-gallery')
            ->width(1600)
            ->height(1000)
            ->nonQueued();
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
        $dateNow = Carbon::now();
        $schedule = $this->attributes['schedule'];

        $days = [];
        foreach (collect(json_decode($schedule, true))->toArray() as $sched) {
            if ($dateNow >= Carbon::parse($sched['date_start'])) {
                $days[] = $sched['day'];
            }
        }

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
        static::created(function ($model) {
            if ($model->slug == '') {
                return;
            }

            $model->slug = Str::slug($model->slug);
            $model->save();
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->slug);
        });
    }
}
