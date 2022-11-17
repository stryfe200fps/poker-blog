<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageService 
{

  public function imageUploadByRequest($model, $url)
  {
     $value = $url;
     dd($value);
  }

  public function imageUpload($model)
  {
        $value = request()->only('image')['image'] ?? $model->image ?? '';

        dd($value);

        if ($value == null) {
            $model->media()->delete();

          // try { 
          //   \Artisan::call('media-library:clean --force');
          //   } catch (Exception $e) { } 
          //   return false;
          // }

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            dd('this is a url');
            return false;
        }

        $path = public_path(). '/tmp/' . $model->mediaCollection . '-'. $model->id . '.jpg';
        $image = \Image::make($value)->encode('jpg', 100)->save($path);

        if ( isset($model?->shouldResizeImage) && $model?->shouldResizeImage) 
            $image->resize(1600,900)->save($path);

        $model->media()->delete();

        // try { 
        // \Artisan::call('media-library:clean --force');
        // } catch (Exception $e) { } 

         $model->addMedia($path)
        ->toMediaCollection($model->mediaCollection);

        if (file_exists($path))
          unlink($path);

        if (isset($model?->shouldOptimizeImage) && $model?->shouldOptimizeImage)  { 
          if (is_array($model->media) && count($model->media) > 0) {
            $media = $model->media()->get()[0]->getPath();
            ImageOptimizer::optimize($media);
          }
        }
  }
}
