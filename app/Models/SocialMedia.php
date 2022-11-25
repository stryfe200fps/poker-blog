<?php

namespace App\Models;

use App\Observers\MediaObserver;
use App\Traits\HasMediaCaching;
use App\Traits\HasMediaCollection;
use App\Traits\HasMultipleImages;
use App\Traits\RecordMedia;
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

    use RecordMedia;

}
