<?php

namespace App\Models;

use App\Observers\SlugObserver;
use App\Observers\ImageThemeObserver;
use App\Observers\MediaObserver;
use App\Traits\HasMediaCaching;
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

    protected $guarded = [
        'id',
    ];

    // protected $appends = ['image'];

    public $timestamps = false;

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl($this->mediaCollection);
    }

    public function live_report()
    {
        return $this->belongsTo(EventReport::class);
    }

}
