<?php

namespace App\Observers;

use App\Models\ImageTheme;

class ImageThemeObserver
{

    public function saved($model) {

        $value = request()->only('image')['image'];

        if ($value == null) {
            $model->media()->delete();
            return false;
        }

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            return false;
        }
        
        $model->media()->delete();
        $model->addMediaFromBase64($value)
            ->toMediaCollection('image-theme');

    }

}
