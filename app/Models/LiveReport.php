<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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


 

    // protected $attributes = [
    //     'logo' => ''
    // ];

    protected $casts = [
        'players' => 'json',
    ];


    public function getFeaturedImageAttribute($value)
    {
        return $this->getFirstMediaUrl('logo', 'img-logo');
    }

    public function setFeaturedImageAttribute($value)
    {

        $this->addMediaFromBase64($value)
            ->toMediaCollection('logo');
    }

    // protected function featured_image(): Attribute
    // {
    //     return new Attribute(
    //         get: fn () => 'yes',
    //         set: fn() => dd('burat')
    //     );
    // }

    // protected function logo(): Attribute 
    // {
    //     return Attribute::make(
    //         get: fn($value) => $this->getFirstMediaUrl('logo', 'img-logo'),
    //         set: fn($value) =>  dd('burathing') 
    //     );
    // }


    public function event_schedule()
    {
        return $this->belongsTo(EventSchedule::class);
    }

    public function liveReportPlayers()
    {
        return $this->belongsToMany(LiveReportPlayer::class);
    }
}
