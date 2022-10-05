<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tournament extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main-image')
            ->width(424)
            ->height(285);

        $this->addMediaConversion('main-thumb')
            ->width(337)
            ->height(225);
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('tournament', 'main-image');
    }

    public function setImageAttribute($value)
    {
       if ($value == null) 
            $this->media()->delete();

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) 
            return false;

        $this->media()->delete();
        $this->addMediaFromBase64($value)
            ->toMediaCollection('tournament');
    }

    protected $guarded = [
        'id',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function timezones()
    {
        return [

        ];
    }

    public function getParentAttribute($value)
    {
        return $this->tour()->first()->title.' > '.$this->title;
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
