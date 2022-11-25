<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use Illuminate\Support\Facades\File;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Day extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasMediaCollection;
    use HasMultipleImages;
    public $mediaCollection = 'event_gallery';
    public $shouldResizeImage = true;
=======
use Illuminate\Database\Query\Builder;
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
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

    protected $guarded = [
        'id',
    ];

    public function openReport($crud = false)
    {
<<<<<<< HEAD
        return '<a class="btn btn-sm btn-link"  href="report?day=' . urlencode($this->attributes['id']) . '&event=' . urlencode($this->attributes['event_id']) . '" data-toggle="tooltip" title="Days"><i class="fa fa-search"></i> Report  </a>';
=======
        return '<a class="btn btn-sm btn-link"  href="report?day='.urlencode($this->attributes['id']).'&event='.urlencode($this->attributes['event_id']).'" data-toggle="tooltip" title="Days"><i class="fa fa-search"></i> Report  </a>';
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }

    public function openChipCount($crud = false)
    {
<<<<<<< HEAD
        return '<a class="btn btn-sm btn-link"  href="chip-count?day=' . urlencode($this->attributes['id']) . '&event=' . urlencode($this->attributes['event_id']) . '"><i class="fa fa-search"></i> Chip Counts  </a>';
=======
        return '<a class="btn btn-sm btn-link"  href="chip-count?day='.urlencode($this->attributes['id']).'&event='.urlencode($this->attributes['event_id']).'"><i class="fa fa-search"></i> Chip Counts  </a>';
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }

    public function event_reports()
    {
        return $this->hasMany(EventReport::class);
    }

<<<<<<< HEAD
    public function event()
    {
=======
    public function event() {
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
<<<<<<< HEAD
=======

>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
            if ($model->event_reports()->count()) {
                // \Alert::add('error', 'This day has reports inside');
                return false;
            }
        });

        static::created(function ($model) {
            $days = Day::orderBy('lft', 'DESC')->where('event_id', $model->event->id)->firstOrFail();

<<<<<<< HEAD
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
=======
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

>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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

<<<<<<< HEAD
    public function hasImage()
    {
        return $this->lastImage() !== null;
=======
    public function hasImage() 
    {
       return $this->lastImage() !== null;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }

    public function hasImageInStorage()
    {
<<<<<<< HEAD
        $media = collect($this->lastImage()->media);

        if ($media->count()) {
            return File::exists($this->lastImage()->media[0]->getPath('xs-image'));
        }

        return false;
    }

    public function lastImage()
    {
        return $this->event_reports()->latest('published_date')->first();
=======
        $media =collect($this->lastImage()->media); 

        if ($media->count())
            return File::exists($this->lastImage()->media[0]->getPath('xs-image'));
       
        return false;
    }

    public function lastImage() 
    {
       return $this->event_reports()->latest('published_date')->first();
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }

    public function status()
    {
        $dateNow = Carbon::now();
<<<<<<< HEAD
        if ($dateNow >= Carbon::parse($this->date_start) && $dateNow <= Carbon::parse($this->date_end)) {
            return 'live';
        }

        if (Carbon::parse($this->date_start) >= $dateNow) {
            return 'upcoming';
        }

        if (Carbon::parse($this->date_end) <= $dateNow) {
            return 'end';
        }
=======
        if ($dateNow >= Carbon::parse($this->date_start) && $dateNow <= Carbon::parse($this->date_end)) 
            return 'live';
        
        if (Carbon::parse($this->date_start) >= $dateNow) 
            return 'upcoming';

        if (Carbon::parse($this->date_end) <= $dateNow) 
            return 'end';
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

        return 'upcoming';
    }

    public function scopeCurrentStatus($query)
    {
<<<<<<< HEAD
        return $query
            ->whereDate('date_start', '>=', Carbon::parse(Carbon::now())->toDateString())
            ->whereDate('date_end', '<=', Carbon::parse(Carbon::now())->toDateString());
=======
         return $query
            ->whereDate('date_start', '>=' , Carbon::parse(Carbon::now())->toDateString() )
            ->whereDate('date_end', '<=' , Carbon::parse(Carbon::now())->toDateString() );
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }

    public function scopeLive($query)
    {
        return $query->where(function ($q) {
            $q->currentStatus();
        });
    }
}
