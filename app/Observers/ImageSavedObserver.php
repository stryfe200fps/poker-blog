<?php

namespace App\Observers;


use Illuminate\Support\Str;
use App\Services\ImageService;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageSavedObserver
{
    public $afterCommit = true;

    public function saved($model) {

        if ($model?->image === null)
            return;

        $service = app()->make(ImageService::class);
        $service->imageUpload($model);
    }
}
