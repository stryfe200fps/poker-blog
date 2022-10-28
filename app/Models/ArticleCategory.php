<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategory extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'article_categories';

    protected $fillable = [
        'title',
        'slug',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

        protected static function booted()
    {
       

             static::updating(function ($model) {

            $findModel = ArticleCategory::find($model->id);
             if ($model->slug !== $findModel->slug) {
                $model->slug = Str::slug($model->slug);
            } 
        });
    }
}
