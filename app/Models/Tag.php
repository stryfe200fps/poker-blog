<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected $guarded = [
        'id',
    ];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function event_reports()
    {
        return $this->morphedByMany(EventReport::class, 'taggable');
    }

        protected static function booted()
        {
            static::creating(function ($model) {
                if ($model->slug == '') {
                    return;
                }

                $model->slug = Str::slug($model->slug);
            });

                 static::updating(function ($model) {

            $findModel = Tag::find($model->id);

            if ($model->title !== $findModel->title && $model->slug !== $findModel->slug) {
                $model->slug = Str::slug($model->slug);
            } else if ($model->title !== $findModel->title) {
                $model->slug = $findModel->slug;
            } else {
                $model->slug = Str::slug($model->slug);
            }
        });
        }

    // public function tags()
    // {
    //     return $this->morphToMany(Tag::class, 'taggable');
    // }
}
