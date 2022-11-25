<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Prunable;
use App\Traits\HasMediaCaching;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\File;
use App\Observers\EventReportObserver;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use Illuminate\Database\Eloquent\Model;
use App\Observers\ModelTaggableObserver;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventReport extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Prunable;
    use HasMediaCaching;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    public $shouldCacheImage = true;
    public $shouldResizeImage = true;
    protected $guarded = ['id'];

    protected $casts = [
        'players' => 'json',
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(new SlugObserver());
        self::observe(new MediaObserver());
        self::observe(new EventReportObserver());
        self::observe(new ModelTaggableObserver());
    }

    public $mediaCollection = 'event-report';

    public function event()
    {
        return $this->belongsToThrough(Event::class, Day::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function hasImage()
    {
        if ($this->media->count()) {
            return File::exists($this->media[0]->getPath('xs-image'));
        }

        return false;
    }

    public function hasOriginalImage()
    {
        if ($this->media->count()) {
            return File::exists($this->media[0]->getPath());
        }

        return false;
    }

    public function image_theme()
    {
        return $this->belongsTo(ImageTheme::class);
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
        return $this->belongsTo(Author::class);
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

    public function getEventChipPlayersAttribute()
    {
        return EventChip::where('event_report_id', $this->id)->get();
    }

    public function getPlayersAttribute()
    {
        return EventChip::where('event_report_id', $this->id)->get();
    }

    public function setPublishedDateAttribute($value)
    {
        $this->attributes['published_date'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    }

    public function getRealtimeDateAttribute()
    {
        return Carbon::parse($this->attributes['published_date'],$this->event->tournament->word_timezone);
    }

    public function getPublishedDateAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
    }

    public function handleDatePublish($date)
    {
        $timezone = $this->event->tournament->minimizedTimezone;
        $date =  Carbon::parse($date)->setTimezone($this->event->tournament->word_timezone);
        $from = Carbon::parse($date);
        $diffInDays = now()->diffInDays($from);

        if ($diffInDays > 7) {
            return $date->format(config('app.carbon_date_format')) . $timezone;
        }

        return $date->diffForHumans(null, ['long' => true, 'parts' => 2]);
    }

    public static function lastLevel()
    {
        return Level::where('event_id', session()->get('event_id'))->orderByDesc('created_at')->first();
    }

    public function shareFacebook()
    {
        return '<a class="btn btn-sm btn-link"  href="https://www.facebook.com/sharer/sharer.php?u=' . config('app.url') . '/tours/tour/series/event/update-' . $this->id . '" data-toggle="tooltip" target="_blank" title="Share to facebook"><i class="la la-facebook"></i>    </a>';
    }

    public function shareTwitter()
    {
        return '<a class="btn btn-sm btn-link"  href="https://twitter.com/intent/tweet?text=' . config('app.url') . '/tours/tour/series/event/update-' . $this->id . '" data-toggle="tooltip" target="_blank" title="Share to facebook"><i class="la la-twitter"></i>    </a>';
    }
}
