<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tour extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = ['id'];

    public function registerMediaConversions(?Media $media = null): void
    {
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

    public function setImageAttribute($value)
    {
       if ($value == null) 
            $this->media()->delete();

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) 
            return false;



        $this->addMediaFromBase64($value)
            ->toMediaCollection('tour');
    }
}
