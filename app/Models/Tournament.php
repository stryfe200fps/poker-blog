<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasMediaCollection;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tournament extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;
    use HasMediaCollection, HasMultipleImages;

    public $mediaCollection = 'tournament';

    public static function boot()
    {
        parent::boot();
        self::observe(new SlugObserver);
        self::observe(new MediaObserver);
    }

    // protected $appends = [
    //     'minimized_timezone',
    //     'word_timezone'

    // ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }


    public function getMinimizedTimezoneAttribute()
    {
        $timezone = explode(' ', $this->timezone)[0];
        return preg_replace('/([A-Z()])/','', $timezone);
    }

    public function getWordTimezoneAttribute()
    {
        $timezone = explode(' ', $this->timezone)[1];
        return $timezone;
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

    public function hasLiveEvents()
    {
        foreach ($this->events()->get() as $event) {
            if ($event->status() === 'live') {
                return 'live';
            }
        }

        return 'past';
    }

    protected $guarded = [
        'id',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getParentAttribute($value)
    {
        return $this->tour()->first()->title.' > '.$this->title;
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public static function selectAvailableTours()
    {
        return Tour::select('slug', 'title')->orderBy('title')->withCount('tournaments')
            ->having('tournaments_count', '>', 0 )->get();
    }

    public static function selectAvailableCountries()
    {
        return Country::select('name', 'iso_3166_2')->orderBy('name')->withCount('tournaments')
            ->having('tournaments_count', '>', 0 )->get();
    }

    public static function selectAvailableGamesInEvents()
    {
        return EventGameTable::select(['title', 'code'])->orderBy('title')->withCount('events')
            ->having('events_count', '>', 0 )->get();
    }

    public static function selectYearFilter($slug)
    {
        $ad = Tournament::whereHas('tour', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->withCount('events')
            ->having('events_count', '>=', 0 )->get();
        $things = $ad->groupBy(function ($item) {
            return Carbon::parse($item->date_start)->format('Y');
        });

        return $things->keys()->toArray() ;
    }
}
