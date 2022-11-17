<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use App\Observers\ImageSavedObserver;
use App\Observers\ImageThemeObserver;
use App\Observers\DefaultModelObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Badge extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    use InteractsWithMedia;
    protected $guarded = ['id'];
    public $mediaCollection = 'badge';

    public static function boot()
    {
        parent::boot();
        self::observe(new ImageThemeObserver);
        self::observe(new ImageSavedObserver);
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('badge');
    }

}
