<?php

namespace App\Models;

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

    public $timestamps = false;

    public function registerMediaConversions(?Media $media = null): void
    {

    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('image-theme');
    }

    public function setImageAttribute($value)
    {
        if ($value == null) 
            $this->media()->delete();

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) 
            return false;


        $this->addMediaFromBase64($value)
            ->toMediaCollection('image-theme');
    }

    public function live_report()
    {
        return $this->belongsTo(EventReport::class);
    }
}
