<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArticleAuthor extends Model implements HasMedia
{
    use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar-img')
            ->width(50)
            ->height(50);
    }

    public function getAvatarAttribute($value)
    {
        return $this->getFirstMediaUrl('avatar', 'avatar-img');
    }

    public function setAvatarAttribute($value)
    {
        if ($value == null || preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            return false;
        }
        $this->addMediaFromBase64($value)
            ->toMediaCollection('avatar');
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
}
