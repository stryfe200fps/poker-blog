<?php

namespace App\Traits;

use App\Http\Resources\CachedImageResource;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Cache;

trait HasMediaCollection
{
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        foreach (get_class_methods($this) as $method) {
            if (str_starts_with($method, 'hasMediaCollection')) {
                $this->{$method}();
            }
        }
    }

    public function allMedia()
    {
        $img = $this->getMedia($this->mediaCollection);

       $images =   is_countable($img) && count($img) 
        > 0 ? new ImageResource( $img[0]) : '' ;

        return $images;
    }

    public function allMediaWithCaching()
    {

        $img = $this->getMedia($this->mediaCollection);

        $images =   is_countable($img) && count($img) 
        > 0 ? new CachedImageResource( $img[0]) : '' ;

        return $images;
    }

    public function getImageAttribute()
    {
        return $this?->getFirstMediaUrl($this->mediaCollection);
    }

    public function allCollectionMedia()
    {
        $img = $this->getMedia($this->mediaCollection);
        $images =   is_countable($img) && count($img) 
        > 0 ?  ImageResource::collection($img) : '' ;

        return $images;
    }

  
}
