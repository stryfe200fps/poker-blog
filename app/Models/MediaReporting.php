<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use App\Traits\HasMediaCollection;
use App\Traits\PublishedDateConvert;
use App\Observers\SlugObserver;
use App\Observers\MediaObserver;
use App\Services\ImageService;
use App\Traits\RecordMedia;
use App\Traits\RecordSlug;
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
    use RecordMedia;

    public $mediaCollection = 'media-reporting';

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
