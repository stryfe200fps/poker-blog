<?php

namespace App\Observers;

use Illuminate\Support\Str;
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

        $value = request()->only('image')['image'] ?? '';

        if ($value == null) {
            $model->media()->delete();
            return false;
        }

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            return false;
        }

        $path = public_path(). '/tmp/' . $model->mediaCollection . '-'. $model->id . '.jpg';
        $image = \Image::make($value)->encode('jpg', 100)->resize(1600,900)->save($path);

        $model->media()->delete();
        $model->addMedia($path)
        ->toMediaCollection($model->mediaCollection);

        $media = $model->media()->get()[0]->getPath();
        ImageOptimizer::optimize($media);
    }
}
