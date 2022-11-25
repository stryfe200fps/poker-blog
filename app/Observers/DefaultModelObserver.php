<?php

namespace App\Observers;


use Illuminate\Support\Str;
use App\Services\ImageService;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class DefaultModelObserver
{
    public $afterCommit = true;

    public function creating($model) {
            if (!isset($model->slug))
                return;

            if ($model->slug == '') {
                return false;
            }
            $model->slug = Str::slug($model->slug);
    }


    public function updating($model) {
        if (!isset($model->slug))
                return false;

           $findModel =  app()->make(get_class($model))->find($model->id);
             if ($model->slug !== $findModel->slug) {
                $model->slug = Str::slug($model->slug);
            } 
    }

    public function saved($model) {

        if ($model?->image === null)
            return;

        $service = app()->make(ImageService::class);
        $service->imageUpload($model);
    }
}
