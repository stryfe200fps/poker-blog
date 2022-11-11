<?php

namespace App\Models;

use App\Observers\DefaultModelObserver;
use App\Observers\ImageThemeObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageTheme extends Model implements HasMedia
{
    use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        self::observe(new ImageThemeObserver);
    }

    protected $guarded = [
        'id',
    ];

    protected $appends = ['image'];

    public $timestamps = false;

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('image-theme');
    }

    public function live_report()
    {
        return $this->belongsTo(EventReport::class);
    }

    

}
