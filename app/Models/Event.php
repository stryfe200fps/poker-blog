<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    protected $appends = [
        'event_date_start',
        'event_date_end'
    ];

    public function getEventDateStartAttribute()
    {
       $dateStart = $this->attributes['date_start'];
       return \Carbon\Carbon::parse($dateStart)->setTimezone($this->tournament->timezone ?? 'UTC');
    }

    public function getEventDateEndAttribute()
    {
    $dateEnd = $this->attributes['date_end'];
       return \Carbon\Carbon::parse($dateEnd)->setTimezone($this->tournament->timezone ?? 'UTC');
    }

    public function setScheduleAttribute($schedule)
    {
        $scheduledArray = collect($schedule)->map(function ($item) {
           $item['date_start'] = Carbon::parse($item['date_start'], session()->get('timezone') ?? 'UTC')
           ->setTimezone('UTC')
           ->toDateTimeString();
           
            $item['date_end'] = Carbon::parse($item['date_end'], session()->get('timezone') ?? 'UTC')
           ->setTimezone('UTC')
           ->toDateTimeString();

            return $item;
        });
        $this->attributes['schedule'] = $scheduledArray;
    }

    public function getScheduleAttribute($schedule) 
    {
        $sched = json_decode($schedule, true);

        $scheduledArray = collect($sched)->map(function ($item) {
           $item['date_start'] = Carbon::parse($item['date_start'])
           ->setTimezone(session()->get('timezone') ?? 'UTC')
           ->toDateTimeString();
           
            $item['date_end'] = Carbon::parse($item['date_end'])
           ->setTimezone(session()->get('timezone') ?? 'UTC')
           ->toDateTimeString();

            return $item;
        });

       return $scheduledArray;
    }

    // public function getScheduleAttribute($schedule)
    // {
    //     $nice = collect($schedule)->map(function ($item) {
    //        $item['date_start'] = Carbon::parse($item['date_start'], session()->get('timezone'))
    //        ->setTimezone('UTC')
    //        ->toDateTimeString();
           
    //         $item['date_end'] = Carbon::parse($item['date_end'], session()->get('timezone'))
    //        ->setTimezone('UTC')
    //        ->toDateTimeString();

    //         return $item;
    //     });
    // }



    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function currentDay() 
    {
        $dateNow = Carbon::now();
        foreach ( json_decode($this->attributes['schedule'], true) ?? [] as $sched) {
            if ( $dateNow >= Carbon::parse($sched['date_start'])  && $dateNow <= Carbon::parse($sched['date_end'])) {
                return $sched['day'];
            }
        }
        return 0;
    }

    public function status()
    {
        $dateNow = Carbon::now();
        foreach ( json_decode($this->attributes['schedule'], true) ?? [] as $sched) {
            if ( $dateNow >= Carbon::parse($sched['date_start'])  && $dateNow <= Carbon::parse($sched['date_end'])) {
                return 'live';
            } else if ( $dateNow <= Carbon::parse($sched['date_start'])->addDays(2)  ) {
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
        $schedules = json_decode($this->attributes['schedule'], true) ;

        if (!is_countable($schedules)) 
            return 'no schedule yet';


        foreach ( $schedules as $sched) {
            if ( $dateNow >= Carbon::parse($sched['date_start'])  && $dateNow <= Carbon::parse($sched['date_end'])) {
                return 'Day '. $sched['day'] . '  :  '  . Carbon::parse($sched['date_start'])->format('M j, Y, ga D') .' to '. Carbon::parse($sched['date_end'])->format('M j, Y, ga D')  . '   -   '.  Carbon::parse( $sched['date_start'] )->diffForHumans() ;
            }
        }

        //upcoming

        foreach ( $schedules as $sched) {
            if ( $dateNow <  Carbon::parse($sched['date_start'])) {
                // date("F j, Y, g:i a"); 
                // $hora = Carbon::parse($sched['date_start'])->format('M j, Y, ga D');
                // dd($hora);
                return 'Day '. $sched['day'] . '  :  '  . Carbon::parse($sched['date_start'])->format('M j, Y, ga D') .' to '. Carbon::parse($sched['date_end'])->format('M j, Y, ga D')  . '   -   '.  Carbon::parse( $sched['date_start'] )->diffForHumans() ;
            }
        }

        return 'schedule ended ' . Carbon::parse($schedules[count($schedules) - 1]['date_end'])->diffForHumans() ;
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
          if ($value == null) 
            $this->media()->delete();

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) 
            return false;



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
        // $days = collect(json_decode($schedule, true ))->map(function ($item) use ($dateNow) {
        //     if ($dateNow >= Carbon::parse($item['date_start']))
        //         return $item['day'];

        // });

        $days = [];
        foreach ( collect(json_decode($schedule, true ))->toArray() as $sched ) {
            if ($dateNow >= Carbon::parse($sched['date_start']))
                $days[] = $sched['day']; 

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

    public function setDateStartAttribute($value) 
    {
        $this->attributes['date_start'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    }

    public function getDateStartAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
    }

    public function setDateEndAttribute($value) 
    {

        $this->attributes['date_end'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    }
    
    public function getDateEndAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
    }



    protected static function booted()
    {
        static::created(function ($model) {

        if ($model->slug == '')
            return;

        $model->slug = Str::slug($model->slug);
        $model->save();
        });

        static::updating(function ($model) {
        $model->slug = Str::slug($model->slug);
        });
    }

}
