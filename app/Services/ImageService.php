<?php

namespace App\Services;

use Backpack\Settings\app\Models\Setting;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

final class ImageService 
{

  public function __construct(protected UploadedFile|string $imageInput, protected Model $currentModel)
  {

  }

  protected $currentImage = null;
  protected $currentImagePath = '';

  public function imageUpload()
  {
        try { 

        $url = preg_replace('/^https?:\/\//','' , config('app.url'));
        // check if the image is already existing
        if ( preg_match("/$url\/storage\/\d*\/\w*[?-]?\w*[?-]\w*.\w*/", $this->imageInput)) {
            return false;
        }
        } catch (Exception $e) { }


        if ($this->imageInput == null || $this->imageInput == '') { 
            $this->currentModel->media()->delete();
            return false;
        }

        // CHECK if image is base64 or URL
        if ($this->validateUploadedImage($this->imageInput)) { 

        $this->imageResize($this->currentImagePath, $this->currentImage);
        $this->saveMediaPath();
        $this->imageOptimize();

        }

        return $this->currentImage ?? $this->currentImagePath;
  }


  private function getImageExtensionName()
  {
    $extension = 'jpg';

    if ($this->getImageType($this->imageInput) === 'UploadedFile')
      $extension = explode('/', mime_content_type($this->imageInput))[1];

    return $extension ;
  }

  private function getCurrentImagePath()
  {
    if ($this->getImageType($this->imageInput) !== 'UploadedFile')
      return $this->currentImagePath = public_path(). '/tmp/' . $this->currentModel->mediaCollection . '-'. $this->currentModel->id . '.'. $this->getImageExtensionName();

      return;
  }

  private function saveMediaPath() : void
  {
      $this->deleteOldMedia();
      $this->currentModel->addMedia($this->currentImagePath)
        ->toMediaCollection($this->currentModel->mediaCollection);
      $this->deleteImagePath($this->currentImagePath);
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
    // dd(filter_var($value, FILTER_VALIDATE_URL));

    if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 1)
        return $this->imageBase64Upload($value);
    else if (filter_var($value, FILTER_VALIDATE_URL))
        return $this->imageUrlUpload($value);
    else if (gettype($value) === 'object' &&  $this->getImageType($value) === 'UploadedFile') 
        return $this->imageFileUpload($value);
    
  }

  private function getImageType($value)
  {
    if (gettype($value) === 'object')
      return  (new \ReflectionClass(get_class($value)))->getShortName();

    return false;

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

