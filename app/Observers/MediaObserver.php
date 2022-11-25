<?php

namespace App\Observers;


use Illuminate\Support\Str;
use App\Services\ImageService;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class MediaObserver
{
    public $afterCommit = true;

    public function saved($model) {

        if ($model?->image === null)
            return;

        if (!request()->has('image'))
            return;

        $image = request()->input('image')  ?? request()->all()['image'] ?? $model->getAttributes()['image'] ?? '';


        (new ImageService($image, $model))->imageUpload();
    }
}
