<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

final class ImageService 
{

  protected $currentModel = null;

  protected $currentImage = null;

  protected $currentImagePath = '';


  public function imageUpload($model)
  {

        $this->currentModel = $model;

        $value = request()->only('image')['image'] ?? $model->getAttributes()['image'] ?? '';

        if ($value == null || $value == '') { 
            $model->media()->delete();
            return false;
        }

        // CHECK if image is base64 or URL
        $this->validateUploadedImage($value);

        $this->imageResize($this->currentImagePath, $this->currentImage);
        $this->saveMediaPath($this->currentImagePath);
        $this->imageOptimize();
        
  }

  private function encodeImageAsJpg($value)
  {
    $this->currentImage = \Image::make($value)->encode('jpg', 100)->save($this->getCurrentImagePath());
  }

  private function getCurrentImagePath()
  {
    return $this->currentImagePath = public_path(). '/tmp/' . $this->currentModel->mediaCollection . '-'. $this->currentModel->id . '.jpg';
  }

  private function saveImageFromUrl($value)
  {
    $this->currentImage = \Image::make($value)->save($this->getCurrentImagePath());
  } 

  private function imageResize($path, $image)
  {
      if ( isset($this->currentModel?->shouldResizeImage) && $this->currentModel?->shouldResizeImage) 
      $image->resize(1600,900)->save($path);
  }

  private function imageOptimize()
  {
      if (isset($this->currentModel?->shouldOptimizeImage) && $this->currentModel?->shouldOptimizeImage)  { 
          if (is_array($this->currentModel?->media) && count($this->currentModel?->media) > 0) {
            $media = $this->currentModel?->media()->get()[0]->getPath();
            ImageOptimizer::optimize($media);
          }
    }
  }

  private function deleteImagePath($path)
  {
      if (file_exists($path))
          unlink($path);
  }

  private function saveMediaPath($path) 
  {
      $this->deleteOldMedia();
      $this->currentModel->addMedia($path)
        ->toMediaCollection($this->currentModel->mediaCollection);
      $this->deleteImagePath($path);
  }

  private function deleteOldMedia()
  {
      $this->currentModel->media()->delete();
  }

  //check what type of image is being uploaded
  public function validateUploadedImage($value)
  {

    if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 1)
        return $this->imageBase64Upload($value);
    else if (filter_var($value, FILTER_VALIDATE_URL))
        return $this->imageUrlUpload($value);
  }

  public function imageBase64Upload($value)
  {
    $this->encodeImageAsJpg($value);
  }

  public function imageUrlUpload($link)
  {
    $this->saveImageFromUrl($link);
  }


}

