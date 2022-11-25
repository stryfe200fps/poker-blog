<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use App\Observers\MediaObserver;
use App\Observers\ImageThemeObserver;
use App\Observers\SlugObserver;
use App\Traits\HasMediaCaching;
use App\Traits\RecordMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Badge extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    // use InteractsWithMedia;
    use HasMediaCaching;
    protected $guarded = ['id'];
    public $mediaCollection = 'badge';

    use RecordMedia;

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('badge');
    }

    public function setImageAttribute($value)
    {
        // if ($value == null) { 
        //     $this->attributes['image'] = 'kantot';
        //     return ;
        // }

        $this->attributes['image'] = $value;
    }

}
