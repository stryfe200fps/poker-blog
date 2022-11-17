<?php

namespace App\Traits;

use Spatie\Image\Manipulations;

trait HasMultipleImages
{

    public function hasMediaCollectionMultipleImages()
    {
        $this->addMediaCollection($this->mediaCollection)
            ->registerMediaConversions(function () {

                $this->addMediaConversion('xs-image')
                    ->width(config('app.xs-image')[0])
                    ->height(config('app.xs-image')[1]);

                $this->addMediaConversion('sm-image')
                    ->width(config('app.sm-image')[0])
                    ->height(config('app.sm-image')[1]);

                $this->addMediaConversion('md-image')
                    ->width(config('app.md-image')[0])
                    ->height(config('app.md-image')[1]);

                $this->addMediaConversion('lg-image')
                    ->width(config('app.lg-image')[0])
                    ->height(config('app.lg-image')[1]);


                $this->addMediaConversion('xl-image')
                    ->width(config('app.xl-image')[0])
                    ->height(config('app.xl-image')[1]);
       });
    }
}