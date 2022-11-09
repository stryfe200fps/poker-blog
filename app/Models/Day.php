<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Day extends Model implements HasMedia
{
    // use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public $mediaCollection = 'event_gallery';
    use HasMediaCollection, HasMultipleImages;

    protected $guarded = [
        'id',
    ];

    // public function registerMediaConversions(?Media $media = null): void
    // {
    //     $this->addMediaConversion('big-image')
    //         ->width(1200)
    //         ->height(630)
    //         ->nonQueued();
    //     $this->addMediaConversion('main-gallery-thumb')
    //         ->width(130)
    //         ->height(86);

    //     $this->addMediaConversion('main-gallery');
    // }

    public function openReport($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="report?day='.urlencode($this->attributes['id']).'&event='.urlencode($this->attributes['event_id']).'" data-toggle="tooltip" title="Days"><i class="fa fa-search"></i> Report  </a>';
    }

    public function openChipCount($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="chip-count?day='.urlencode($this->attributes['id']).'&event='.urlencode($this->attributes['event_id']).'"><i class="fa fa-search"></i> Chip Counts  </a>';
    }

    public function event_reports()
    {
        return $this->hasMany(EventReport::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function report_count()
    {
        return $this->event_reports()->count();
    }

    public function event_chips()
    {
        return $this->hasMany(EventChip::class);
    }

    public function latest_event_chips()
    {
        return $this->event_chips()->with(['player', 'player.country', 'player.media'])->orderBy('published_date', 'DESC')->get()->flatten()->unique('player_id')->sortByDesc('current_chips');
    }

    public function whatsapp_event_chips()
    {
        return $this->event_chips()->with(['player', 'player.country', 'player.media'])->where('is_whatsapp', true)->orderBy('published_date', 'DESC')->get();
    }

    protected static function booted()
    {
        static::deleting(function ($model) {

            if ($model->event_reports()->count()) {
                // \Alert::add('error', 'This day has reports inside');
                return false;
            }
        });

        static::created(function ($model) {
            $days = Day::orderBy('lft', 'DESC')->where('event_id', $model->event->id)->firstOrFail();

            if ($days->lft !== 0) { 
            $model->parent_id = null;
            $model->lft = $days->lft + 2;
            $model->rgt = $days->lft + 3;
            $model->depth = 1;
            $model->save();
            } else {
            $model->parent_id = null;
            $model->lft = 2;
            $model->rgt = 3;
            $model->depth = 1;
            $model->save();
            }

        });
    }

    public function setDateStartAttribute($value)
    {
        $this->attributes['date_start'] = Carbon::parse($value, session()->get('timezone'))
            ->setTimezone('UTC');
    }

    public function getDateStartAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone'));
    }

    public function setDateEndAttribute($value)
    {
        $this->attributes['date_end'] = Carbon::parse($value, session()->get('timezone'))
            ->setTimezone('UTC');
    }

    public function getDateEndAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone'));
    }

 

}
