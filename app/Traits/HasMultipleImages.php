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
                    ->width(200)
                    ->height(200);

                $this->addMediaConversion('sm-image')
                    ->width(300)
                    ->height(250);

                $this->addMediaConversion('md-image')
                    ->width(640)
                    ->height(480);

                $this->addMediaConversion('lg-image')
                    ->width(900)
                    ->height(600);

                $this->addMediaConversion('xl-image')
                    ->width(1600)
                    ->height(900);
        });
    }
}