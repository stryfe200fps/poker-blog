<?php

namespace App\Traits;


use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

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

    public function getImageAttribute()
    {
        return $this?->getFirstMediaUrl(app()->make(get_class($this))->firstOrFail()->mediaCollection);
    }
}
