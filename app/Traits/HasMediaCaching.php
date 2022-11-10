<?php

namespace App\Traits;

use App\Http\Resources\CachedImageResource;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Cache;

trait HasMediaCaching
{
    use InteractsWithMedia;

    public function getMediaWithCaching()
    {
        $img = $this->getMedia($this->mediaCollection);

        $images =   is_countable($img) && count($img) 
        > 0 ? new CachedImageResource( $img[0]) : '' ;

        return $images;
    }

    public function getImageAttribute()
    {
        $img = $this->getMedia($this->mediaCollection);
        $image =   is_countable($img) && count($img) 
        > 0 ? $img[0] : '' ;
        return $image;
    }

    public function getSocialImageAttribute()
    {

        $img = $this->getMedia($this->mediaCollection);
        $image =   is_countable($img) && count($img) 
        > 0 ? $img[0] : '' ;

        $urlPath = config('app.url') . "/api/images/$image->id";
        return  $urlPath . '?w='.config('app.md-image')[0].'&h='. config('app.md-image')[1];
    }
}
