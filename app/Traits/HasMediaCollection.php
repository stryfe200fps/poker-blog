<?php

namespace App\Traits;


use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


use App\Http\Resources\ImageResource;

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

        // dd($images);
        return $images;
    }

    public function getImageAttribute()
    {
        return $this?->getFirstMediaUrl($this->mediaCollection);
    }
}
