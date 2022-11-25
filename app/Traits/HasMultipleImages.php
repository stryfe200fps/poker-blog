<?php

namespace App\Traits;

<<<<<<< HEAD
use Backpack\Settings\app\Models\Setting;
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
use Spatie\Image\Manipulations;

trait HasMultipleImages
{

    public function hasMediaCollectionMultipleImages()
    {
        $this->addMediaCollection($this->mediaCollection)
            ->registerMediaConversions(function () {

                $this->addMediaConversion('xs-image')
<<<<<<< HEAD
                    ->width(Setting::get('xs_image_width') ?? config('app.xs-image')[0] ?? 200)
                    ->height(Setting::get('xs_image_height') ?? config('app.xs-image')[1] ?? 200);

                $this->addMediaConversion('sm-image')
                    ->width(Setting::get('sm_image_width') ?? config('app.sm-image')[0] ?? 200)
                    ->height(Setting::get('sm_image_height') ?? config('app.sm-image')[1] ?? 200);

                $this->addMediaConversion('md-image')
                    ->width(Setting::get('md_image_width') ?? config('app.md-image')[0] ?? 200)
                    ->height(Setting::get('md_image_height') ?? config('app.md-image')[1] ?? 200);

                $this->addMediaConversion('lg-image')
                    ->width(Setting::get('lg_image_width') ?? config('app.lg-image')[0] ?? 200)
                    ->height(Setting::get('lg_image_height') ?? config('app.lg-image')[1] ?? 200);

                $this->addMediaConversion('xl-image')
                    ->width(Setting::get('xl_image_width') ?? config('app.xl-image')[0] ?? 200)
                    ->height(Setting::get('xl_image_height') ?? config('app.xl-image')[1] ?? 200);
=======
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
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
       });
    }
}