<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public bool $shouldOptimizeImage = false;
    public bool $shouldResizeImage = false;

    protected $guarded = ['id'];
    use HasMediaCollection, HasMultipleImages;

    public $mediaCollection = 'banner';

    public static function boot()
    {
        parent::boot();
        self::observe(new SlugObserver);
            self::observe(new MediaObserver);
    }
}
