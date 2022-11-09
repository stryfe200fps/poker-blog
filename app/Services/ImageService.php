<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageService 
{
  public function imageUpload($model)
  {
     $value = request()->only('image')['image'] ?? '';

        if ($value == null) {
            $model->media()->delete();
            return false;
        }

        // if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
        //     return false;
        // }

        $path = public_path(). '/tmp/' . $model->mediaCollection . '-'. $model->id . '.jpg';
        $image = \Image::make($value)->encode('jpg', 100)->save($path);

        if ( isset($model?->shouldResizeImage) && $model?->shouldResizeImage) 
            $image->resize(1600,900)->save($path);
        

        $model->media()->delete();

        \Artisan::call('media-library:clean');

        $saveImage = $model->addMedia($path)
        ->toMediaCollection($model->mediaCollection);

        if (isset($model?->shouldCacheImage) && $model?->shouldCacheImage)  { 
          if ($saveImage) {

          $arrayMedia = $model->media->toArray();
            if (is_array($arrayMedia) && count($arrayMedia) > 0) {
              Cache::put($model->media[0]->collection_name. '-'. $model->media[0]->model_id,  $model->media[0]->uuid , 36000 );
            }
          }
        } 

        if (isset($model?->shouldOptimizeImage) && $model?->shouldOptimizeImage)  { 
          if (is_array($model->media) && count($model->media) > 0) {
            $media = $model->media()->get()[0]->getPath();
            ImageOptimizer::optimize($media);
          }
        }
  }
}
