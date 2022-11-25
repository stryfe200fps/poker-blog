<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use App\Traits\RecordMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Player extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    use HasMediaCollection;
    use HasMultipleImages;
    use RecordMedia;

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
        static::deleting(function ($deletePlayer) {
            $eventChip = EventChip::where('player_id', $deletePlayer->id)->get();
            if ($eventChip->count()) {
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
        $this->attributes['status'] =  !$value ? 'disabled' : 'enabled';
    }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function openHistory()
    {
        return '<a class="btn btn-sm btn-link"  href="player_history/' . urlencode($this->attributes['id']) . '" data-toggle="tooltip" title="Chip  Count"><i class="fa fa-search"></i> history  </a>';
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function badge()
    {
        return $this->belongsTo(Badge::class);
    }
   
}
