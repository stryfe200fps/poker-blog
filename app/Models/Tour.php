<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Observers\DefaultModelObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tour extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;

    public $mediaCollection = 'tour';

    public static function boot()
    {
        parent::boot();
        self::observe(new DefaultModelObserver);
    }

    protected $guarded = ['id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('big-image')
            ->width(1200)
            ->height(630)
            ->nonQueued();
        $this->addMediaConversion('main-image')
            ->width(424)
            ->height(285)
            ->nonQueued();

        $this->addMediaConversion('main-thumb')
            ->width(337)
            ->height(225)
            ->nonQueued();
    }

    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('tour', 'main-image');
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
