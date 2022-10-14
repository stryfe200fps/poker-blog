<?php

namespace App\Models;

use App\Events\NewReport;
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

    protected $guarded = [
        'id',
    ];

    protected $appends = ['image'];

   

    public $timestamps = false;

    public function registerMediaConversions(?Media $media = null): void
    {

    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('image-theme');
    }

  

    public function live_report()
    {
        return $this->belongsTo(EventReport::class);

    }


    public static function boot(){
       
        parent::boot();
        self::observe(new ImageThemeObserver);
    }

    // protected static function booted()
    // {
    //     static::updating(function ($model) {

    //         dd('qwe');


    //     });

    //     static::updated(function ($model) {

    //         dd('qwe');

    //     });

    //     static::created(function ($model) {

    //         dd('cre');

    //     $value = request()->only('image')['image'];

    //     if ($value == null) {
    //         $model->media()->delete();
    //     }

    //     if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
    //         return false;
    //     }

    //     $model->addMediaFromBase64($value)
    //         ->toMediaCollection('image-theme');

    //     });
    // }
        
        

        // static::updating(function ($model) {



        // });

    
}
