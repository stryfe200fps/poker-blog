<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use App\Observers\DefaultModelObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Player extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    use HasMediaCollection, HasMultipleImages;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar')
            ->width(800)
            ->height(800)
            ->nonQueued();
    }

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::observe(new DefaultModelObserver);

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
        $this->attributes['status'] =  !$value  ? 'disabled' : 'enabled';
    }


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function openHistory()
    {
        return '<a class="btn btn-sm btn-link"  href="player_history/'.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Chip  Count"><i class="fa fa-search"></i> history  </a>';
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    // protected static function booted()
    // {
        
    // }
}
