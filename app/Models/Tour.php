<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasMediaCollection;
<<<<<<< HEAD
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
=======
use App\Observers\DefaultModelObserver;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tour extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;

    use HasMediaCollection, HasMultipleImages;

    public $mediaCollection = 'tour';

    protected $guarded = ['id'];

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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if ($model->slug == '') {
                return;
            }

            $model->slug = Str::slug($model->slug);
        });

        static::updating(function ($model) {

            $findModel = Tour::find($model->id);
             if ($model->slug !== $findModel->slug) {
                $model->slug = Str::slug($model->slug);
            } 
        });
    }

}
