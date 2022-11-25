<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaReportingCategory extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }


    public function media_reportings()
    {
        return $this->belongsToMany(MediaReporting::class);
    }

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::observe(new SlugObserver);
        self::observe(new MediaObserver);
    }
}
