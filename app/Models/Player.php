<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Player extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar')
            ->width(800)
            ->height(800);
    }

    protected $guarded = ['id'];

    public function getAvatarAttribute($value)
    {
        return $this->getFirstMediaUrl('player', 'avatar');
    }

    public function setAvatarAttribute($value)
    {
        if ($value == null || preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            return;
        }

        $this->addMediaFromBase64($value)
            ->toMediaCollection('player');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }



    protected static function booted()
    {

        static::deleting(function ($deletePlayer) {

            // $deletePlayer->id;

            // $deletedReport->event_chips()->delete();

        });
    }
}
