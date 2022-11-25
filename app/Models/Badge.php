<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
<<<<<<< HEAD
use App\Observers\MediaObserver;
use App\Observers\ImageThemeObserver;
use App\Observers\SlugObserver;
use App\Traits\HasMediaCaching;
=======
use App\Observers\ImageThemeObserver;
use App\Observers\DefaultModelObserver;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Badge extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

<<<<<<< HEAD
    // use InteractsWithMedia;
    use HasMediaCaching;
=======
    use InteractsWithMedia;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    protected $guarded = ['id'];
    public $mediaCollection = 'badge';

    public static function boot()
    {
        parent::boot();
<<<<<<< HEAD
        // self::observe(new ImageThemeObserver);
        self::observe(new MediaObserver);
=======
        self::observe(new ImageThemeObserver);
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('badge');
    }

<<<<<<< HEAD
    public function setImageAttribute($value)
    {
        // if ($value == null) { 
        //     $this->attributes['image'] = 'kantot';
        //     return ;
        // }

        $this->attributes['image'] = $value;
    }

=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
}
