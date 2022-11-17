<?php

namespace App\Traits;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

trait LOPDefaultTrait
{
    /**
     * Get the latest entry for each group.
     *
     * Each group is composed of one or more columns that make a unique combination to return the
     * last entry for.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array|null  $fields A list of fields that's considered as a unique entry by the query.
     * @return \Illuminate\Database\Eloquent\Builder
     * 
     * 
     */
   
    protected static function booted()
    {
        static::creating(function ($model) {
            if ($model->slug == '') {
                return;
            }

            $model->slug = Str::slug($model->slug);
        });

        static::updating(function ($model) {
            $findModel =  app()->make(get_class($model))->find($model->id);
             if ($model->slug !== $findModel->slug) {
                $model->slug = Str::slug($model->slug);
            } 
        });

        static::saved(function ($model) {
            $value = request()->only('image')['image'] ?? '';

            if ($value == null) {
                $model->media()->delete();
                return false;
            }

            if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
                return false;
            }

            $path = public_path(). '/tmp/' . $model->mediaCollection . '-'. $model->slug . '.jpg';
            $image = \Image::make($value)->encode('jpg', 100)->resize(1600,900)->save($path);

            $model->addMedia($path)
            ->toMediaCollection($model->mediaCollection);

            $media = $model->media()->get()[0]->getPath();
            ImageOptimizer::optimize($media);
        });
    }


}
