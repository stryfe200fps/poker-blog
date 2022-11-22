<?php

namespace App\Services;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Image;

final class ImageService
{
    public function __construct(protected UploadedFile|string $imageInput, protected Model $currentModel)
    {
    }

    protected $currentImage = null;
    protected $currentImagePath = '';
    protected $imageExtension = 'jpg';

    public function imageUpload(): bool
    {
        // Return false if uploaded the same image
        $url = preg_replace('/^https?:\/\//', '', config('app.url'));
        if (preg_match("/$url\/storage\/\d*\/\w*[?-]?\w*[?-]\w*.\w*/", $this->imageInput)) {
            return false;
        }

        //return false if the image  is null
        if ($this->imageInput == null || $this->imageInput == '') {
            $this->currentModel->media()->delete();
            return false;
        }

        //Check the image type then upload it according to its type.
        if ($this->validateUploadedImage($this->imageInput)) {
            $this->imageResize();
            $this->saveMedia();
            return true;
        }

        return false;
    }

    private function setCurrentImagePath(): void
    {
        if ($this->getImageClassName($this->imageInput) !== 'UploadedFile') {
            $this->currentImagePath = public_path() . '/tmp/' . $this->currentModel->mediaCollection . '-' . $this->currentModel->id . '.' . $this->imageExtension;
        }
    }

    private function saveMedia(): void
    {
        $media = empty($this->currentImagePath)
            ? $this->currentImage : $this->currentImagePath;

        $this->deleteOldMedia();
        $this->currentModel->addMedia($media)
            ->toMediaCollection($this->currentModel->mediaCollection);
        $this->deleteImagePath($this->currentImagePath);
    }

    private function deleteOldMedia(): void
    {
        $this->currentModel->media()->delete();
    }

    public function getProcessedImage(): Image
    {
        return $this->currentImage;
    }

    private function deleteImagePath($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    //check what type of image is being uploaded
    public function validateUploadedImage($value): bool
    {
    // dd(filter_var($value, FILTER_VALIDATE_URL));
        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 1) {
            $this->imageExtension = explode('/', mime_content_type($this->imageInput))[1];
            $this->setCurrentImagePath();
            $this->imageBase64Upload($value);
        } elseif (filter_var($value, FILTER_VALIDATE_URL)) {
            $this->imageExtension = trim(pathinfo(
                parse_url($this->imageInput, PHP_URL_PATH),
                PATHINFO_EXTENSION
            ));
            $this->setCurrentImagePath();
            $this->imageUrlUpload($value);
        } elseif ($this->getImageClassName($value) === 'UploadedFile') {
            $this->currentImage = $value;
        } else {
            return false;
        }

        return true;
    }

    private function getImageClassName($value): string
    {
        if (gettype($value) === 'object') {
            return (new \ReflectionClass(get_class($value)))->getShortName();
        }

        return '';
    }

    // Uploading different image source
    public function imageBase64Upload($value): void
    {
        $this->currentImage = \Image::make($value)->encode($this->imageExtension, 100)->save($this->currentImagePath);
    }

    public function imageUrlUpload($link): void
    {
        if (checkUrlCode($link) === 200) {
            $this->currentImage = \Image::make($link)->save($this->currentImagePath);
        }
    }

    // IMAGE MANIPULATION
    private function imageResize()
    {
        if (isset($this->currentModel?->shouldResizeImage) && $this->currentModel?->shouldResizeImage) {
            $this->currentImage->resize(Setting::get('default_image_width') ?? 1600, Setting::get('default_image_height') ?? 900)->save($this->currentImagePath);
        }
    }
}
