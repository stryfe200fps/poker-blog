<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LiveReport extends Model implements HasMedia
{
    use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;


    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('img-logo')
            ->width(300)
            ->height(300);
    }

    protected $guarded = ['id'];

    protected $casts = [
        'players' => 'json',
    ];

    public function getFeaturedImageAttribute($value)
    {
        return $this->getFirstMediaUrl('logo', 'img-logo');
    }

    // public function players()
    // {
    //     return $this->belongsToMany(Player::class);
    // }

    public function setFeaturedImageAttribute($value)
    {
        $this->addMediaFromBase64($value)
            ->toMediaCollection('logo');
    }

    public function poker_event()
    {
        return $this->belongsTo(PokerEvent::class);
    }

    public function liveReportPlayers()
    {
        return $this->belongsToMany(LiveReportPlayer::class);
    }
}
