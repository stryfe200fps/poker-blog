<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use App\Traits\HasMediaCollection;
use App\Traits\PublishedDateConvert;
<<<<<<< HEAD
use App\Observers\SlugObserver;
use App\Observers\MediaObserver;
use App\Services\ImageService;
=======
use App\Observers\DefaultModelObserver;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;

class MediaReporting extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    use PublishedDateConvert;

    protected $guarded = ['id'];
    use HasMediaCollection, HasMultipleImages;

    public $mediaCollection = 'media-reporting';

    public static function boot()
    {
        parent::boot();
<<<<<<< HEAD
        self::observe(new SlugObserver);
        self::observe(new MediaObserver);
=======
        self::observe(new DefaultModelObserver);
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }


    public function media_reporting_categories()
    {
        return $this->belongsToMany(MediaReportingCategory::class);
    } 

    public static function selectAvailableCategories()
    {
        return MediaReportingCategory::select(['title', 'slug'])->orderBy('title')->withCount('media_reportings')
            ->having('media_reportings_count', '>', 0 )->get();
    }

}
