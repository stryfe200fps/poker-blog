<?php

namespace App\Models;

use App\Observers\MediaObserver;
use App\Traits\HasMediaCaching;
use App\Traits\HasMediaCollection;
use App\Traits\HasMultipleImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class SocialMedia extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaCollection, HasMultipleImages;

    public $mediaCollection = "social-media";
    public $shouldCacheImage = true;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::observe(new MediaObserver);
    }
}
