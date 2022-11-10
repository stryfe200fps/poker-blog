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

    public $mediaCollection = 'room';

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

    public function getImageThumbAttribute($value)
    {
        return $this->getFirstMediaUrl('room', 'main-thumb');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

   public static function selectAvailableCountries()
    {
        return Country::select('name', 'iso_3166_2')->orderBy('name')->withCount('rooms')
            ->having('rooms_count', '>', 0 )->get();
    }
}
