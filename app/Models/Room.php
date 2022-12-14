<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasMediaCollection;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use App\Traits\RecordMedia;
use App\Traits\RecordSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Room extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;

    public $mediaCollection = 'room';

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'features' => 'json',
    ];

    use HasMediaCollection, HasMultipleImages;

    use RecordSlug, RecordMedia;

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
