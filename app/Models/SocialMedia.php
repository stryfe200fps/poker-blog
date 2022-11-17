<?php

namespace App\Models;

use App\Observers\ImageSavedObserver;
use App\Traits\HasMediaCaching;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    use HasMediaCaching;

    public $mediaCollection = "social-media";
    public $shouldCacheImage = true;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::observe(new ImageSavedObserver);
    }
}
