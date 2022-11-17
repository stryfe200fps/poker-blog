<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use App\Observers\ImageSavedObserver;
use App\Observers\DefaultModelObserver;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Author extends Model implements HasMedia
{
    // use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar-img')
            ->width(100)
            ->height(100);
    }

    public $mediaCollection = 'avatar';
    use HasMediaCollection, HasMultipleImages;


    public static function boot()
    {
        parent::boot();
        self::observe(new DefaultModelObserver);
        self::observe(new ImageSavedObserver);
    }


    public function getThumbImageAttribute($value)
    {
        return $this->getFirstMediaUrl($this->mediaCollection, 'avatar-img');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media_reportings()
    {
        return $this->hasMany(MediaReporting::class);
    }
}
