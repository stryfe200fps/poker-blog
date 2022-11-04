<?php

namespace App\Models;

use App\Observers\DefaultModelObserver;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Room extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;

    public $mediaCollection = 'media';

    public static function boot()
    {
        parent::boot();
        self::observe(new DefaultModelObserver);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'features' => 'json',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('big-image')
            ->width(1200)
            ->height(630)
            ->nonQueued();
        $this->addMediaConversion('main-image')
            ->width(424)
            ->height(285)
            ->nonQueued();

        $this->addMediaConversion('main-thumb')
            ->width(337)
            ->height(225)
            ->nonQueued();
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('room', 'main-image');
    }

    public function getImageThumbAttribute($value)
    {
        return $this->getFirstMediaUrl('room', 'main-thumb');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}
