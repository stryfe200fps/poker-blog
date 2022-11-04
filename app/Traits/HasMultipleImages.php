<?php

namespace App\Traits;

use Spatie\Image\Manipulations;

trait HasMultipleImages
{
    public function hasMediaCollectionMultipleImages()
    {

        $this->addMediaCollection(app()->make(get_class($this))->firstOrFail()->mediaCollection)
            ->registerMediaConversions(function () {
// xs-image  200 x 200
// sm-image  300 x 250
// md-image  640 x 480
// lg-image  900 x 600
// xl-image  1600 x 900
                $this->addMediaConversion('xs-image')
                    ->width(200)
                    ->height(200);

                $this->addMediaConversion('sm-image')
                    ->width(300)
                    ->height(250);

                $this->addMediaConversion('md-thumb')
                    ->width(640)
                    ->height(480);

                $this->addMediaConversion('main-gallery-thumb')
                    ->width(130)
                    ->height(86)
                    ->nonQueued();

                $this->addMediaConversion('main-gallery');
            });



    }
}