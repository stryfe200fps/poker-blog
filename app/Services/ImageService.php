<?php

namespace App\Services;

use Backpack\Settings\app\Models\Setting;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

final class ImageService 
{

  public function __construct($image, $model)
  {
    $this->imageInput = $image;
    $this->currentModel = $model;
  }

  protected $currentModel = null;
  protected $imageInput = null;
  protected $currentImage = null;
  protected $currentImagePath = '';


  public function imageUpload()
  {


        // check if the image is already existing
        $url = preg_replace('/http[?s]:\/\//','' , config('app.url'));
        if ( preg_match("/$url\/storage\/\d*\/\w*[?-]?\w*[?-]\w*.\w*/", $this->imageInput)) {
            return false;
        }

        if ($this->imageInput == null || $this->imageInput == '') { 
            $this->currentModel->media()->delete();
            return false;
        }

        // CHECK if image is base64 or URL
        if ($this->validateUploadedImage($this->imageInput)) { 

        $this->imageResize($this->currentImagePath, $this->currentImage);
        $this->saveMediaPath($this->currentImagePath);
        $this->imageOptimize();

        }

        return false;
  }


  private function getImageExtensionName()
  {
    $extension = explode('/', mime_content_type($this->imageInput))[1];
    return $extension ?? 'jpg';
  }

  private function getCurrentImagePath()
  {
    return $this->currentImagePath = public_path(). '/tmp/' . $this->currentModel->mediaCollection . '-'. $this->currentModel->id . '.'. $this->getImageExtensionName();
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

  private function deleteImagePath($path)
  {
      if (file_exists($path))
          unlink($path);
  }

  //check what type of image is being uploaded
  public function validateUploadedImage($value)
  {

    if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 1)
        return $this->imageBase64Upload($value);
    else if (filter_var($value, FILTER_VALIDATE_URL))
        return $this->imageUrlUpload($value);
    else if (gettype($value) === 'object' && (new \ReflectionClass(get_class($value)))->getShortName() === 'UploadedFile') 
        return $this->imageFileUpload($value);
  }


  // Uploading different image source

  public function imageBase64Upload($value, $extension = null)
  {
    $this->currentImage = \Image::make($value)->encode($this->getImageExtensionName(), 100)->save($this->getCurrentImagePath());
    return true;
  }

  public function imageFileUpload($value)
  {
     $this->currentImagePath = $value;
     return true;
  }

  public function imageUrlUpload($link)
  {

    if (checkUrlCode($link) === 200) { 
      $this->currentImage = \Image::make($link)->save($this->getCurrentImagePath());
      return true;
    }

    return false;
  }

  // IMAGE MANIPULATION

  private function imageResize($path, $image)
  {
      if ( isset($this->currentModel?->shouldResizeImage) && $this->currentModel?->shouldResizeImage) 
        $image->resize( Setting::get('default_image_width') ?? 1600 ,Setting::get('default_image_height') ?? 900)->save($path);
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
}

