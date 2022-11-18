<?php

namespace App\Traits;

use Backpack\Settings\app\Models\Setting;
use Spatie\Image\Manipulations;

trait HasMultipleImages
{

    public function hasMediaCollectionMultipleImages()
    {
        $this->addMediaCollection($this->mediaCollection)
            ->registerMediaConversions(function () {

                $this->addMediaConversion('xs-image')
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
       });
    }
}