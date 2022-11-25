<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
<<<<<<< HEAD
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
=======
use App\Observers\DefaultModelObserver;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
<<<<<<< HEAD
        self::observe(new SlugObserver);
            self::observe(new MediaObserver);
=======
        self::observe(new DefaultModelObserver);
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }
}
