<?php
namespace App\Traits;

use App\Models\Tag;
use Illuminate\Support\Str;
use Spatie\Sluggable\SlugOptions;

trait RecordSlug
{
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

  protected static function bootRecordSlug()
  {

        static::creating(function ($model) {
            if (!isset($model->slug))
                return;

            if ($model->slug == '') {
                return false;
            }
            $model->slug = Str::slug($model->slug);

        }) ;


      static::updating(function ($model) {
if (!isset($model->slug))
                return false;

           $findModel =  app()->make(get_class($model))->find($model->id);
             if ($model->slug !== $findModel->slug) {
                $model->slug = Str::slug($model->slug);
            } 



      }) ;
          }

}

