<?php 

namespace App\Traits;

use App\Services\ImageService;

trait RecordMedia
{

  protected static function bootRecordMedia()
  {
    static::saved(function ($model) {

        if ($model?->image === null)
            return;

        if (!request()->has('image'))
            return;

        $image = request()->input('image')  ?? request()->all()['image'] ?? $model->getAttributes()['image'] ?? '';

        (new ImageService($image, $model))->imageUpload();
    });

  }


}
