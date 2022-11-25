<?php

namespace App\Observers;

class ImageThemeObserver
{

    public $afterCommit = true;

    public function saved($model)
    {

        if ($model->mediaCollection === 'badge') { 

            $value = request()->only('image')['image'] ?? '';

        if ($value == '')
            return false;

        if ($value == null) {
            $model->media()->delete();
            return false;
        }

        $model->media()->delete();
        // dd($value);
        // $path = public_path(). '/tmp/' . $model->mediaCollection . '-'. $model->id . '.jpg';
        // $image = \Image::make($value)->encode('jpg', 100)->save($path);
        $model->addMedia($value)
            ->toMediaCollection($model->mediaCollection);
    } else { 

        $value = request()->only('image')['image'] ?? '';

        if ($value == null) {
            $model->media()->delete();
            return false;
        }

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            return false;
        }

        $model->media()->delete();
        $model->addMediaFromBase64($value)
            ->toMediaCollection($model->mediaCollection);

    }

    }
}
