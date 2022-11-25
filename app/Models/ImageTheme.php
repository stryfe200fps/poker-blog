<?php

namespace App\Models;

<<<<<<< HEAD
use App\Observers\SlugObserver;
use App\Observers\ImageThemeObserver;
use App\Observers\MediaObserver;
use App\Traits\HasMediaCaching;
=======
use App\Observers\DefaultModelObserver;
use App\Observers\ImageThemeObserver;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageTheme extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasMediaCaching;

    public $mediaCollection = 'image-theme';

    public static function boot()
    {
        parent::boot();
        self::observe(new MediaObserver);
    }


    public $mediaCollection = 'image-theme';

    public static function boot()
    {
        parent::boot();
        self::observe(new ImageThemeObserver);
    }

    protected $guarded = [
        'id',
    ];

<<<<<<< HEAD
    // protected $appends = ['image'];
=======
    protected $appends = ['image'];
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

    public $timestamps = false;

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl($this->mediaCollection);
    }

    public function live_report()
    {
        return $this->belongsTo(EventReport::class);
    }

<<<<<<< HEAD
=======
    

>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
}
