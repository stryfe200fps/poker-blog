<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
<<<<<<< HEAD
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
=======
use App\Observers\DefaultModelObserver;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Player extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

<<<<<<< HEAD
    use HasMediaCollection;
    use HasMultipleImages;
=======
    use HasMediaCollection, HasMultipleImages;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar')
            ->width(800)
            ->height(800)
            ->nonQueued();
    }


    public bool $shouldResizeImage = true;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
<<<<<<< HEAD
        self::observe(new SlugObserver());
        self::observe(new MediaObserver());
=======
        self::observe(new DefaultModelObserver);
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

        static::deleting(function ($deletePlayer) {
            $eventChip = EventChip::where('player_id', $deletePlayer->id)->get();
            if ($eventChip->count()) {
                // \Alert::add('error', 'This is a red bubble.');
                return false;
            }

            foreach ($eventChip as $chip) {
                $chip->delete();
            }
        });

        static::created(function ($player) {
            Tag::create([
                'title' => ucwords($player->name),
            ]);
        });
    }

    public $mediaCollection = 'player';

    public function getAvatarAttribute($value)
    {
        return $this->getFirstMediaUrl('player', 'avatar');
    }

    public function getStatusAttribute($value)
    {
        return $value === 'disabled' ? 0 : 1;
    }

    public function setStatusAttribute($value)
    {
<<<<<<< HEAD
        $this->attributes['status'] =  !$value ? 'disabled' : 'enabled';
=======
        $this->attributes['status'] =  !$value  ? 'disabled' : 'enabled';
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function openHistory()
    {
<<<<<<< HEAD
        return '<a class="btn btn-sm btn-link"  href="player_history/' . urlencode($this->attributes['id']) . '" data-toggle="tooltip" title="Chip  Count"><i class="fa fa-search"></i> history  </a>';
=======
        return '<a class="btn btn-sm btn-link"  href="player_history/'.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Chip  Count"><i class="fa fa-search"></i> history  </a>';
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
<<<<<<< HEAD
    }

    // protected static function booted()
    // {

=======
    } 

    // protected static function booted()
    // {
        
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    // }
}
