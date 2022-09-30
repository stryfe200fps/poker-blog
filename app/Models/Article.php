<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main-image')
            ->width(424)
            ->height(285);

        $this->addMediaConversion('main-thumb')
            ->width(337)
            ->height(225)
            ;
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function relatedArticles($number = 5) 
    {
        return  Article::where('id', '!=', $this->id )->whereHas('tags', function ($query)  {
            $query->whereIn('slug', $this->tags()->get()->pluck('slug')->toArray());
        })
        ->inRandomOrder()
        ->limit(3) 
        ->get();
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('article', 'main-image');
    }

    public function setImageAttribute($value)
    {
        if ($value == null) 
            $this->media()->delete();

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) 
            return false;

        $this->media()->delete();
        $this->addMediaFromBase64($value)
            ->toMediaCollection('article');
    }

    public function article_tags()
    {
        return $this->belongsToMany(ArticleTag::class);
    }

    public function getDiffAttribute($value)
    {
        return Carbon::parse($this->attributes['published_date'])->diffForHumans();
    }


    protected $guarded = ['id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article_categories()
    {
        return $this->belongsToMany(ArticleCategory::class);
    }

    public function article_author()
    {
        return $this->belongsTo(ArticleAuthor::class);
    }
}
