<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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

    protected $casts = [
        'content' => 'json',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main-image')
            ->width(847)
            ->height(563);

        $this->addMediaConversion('main-thumb')
            ->width(337)
            ->height(225);
    }

    public function setContentAttribute($content)
    {
        $new = collect($content)->map(function ($item, $key) {
            $item['body'] = '<div class="content" id="content'.$key.'">'.$item['body'].'</div>';

            return $item;
        });

        $this->attributes['content'] = json_encode($new->toArray());
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function relatedArticles($number = 5)
    {
        return  Article::where('id', '!=', $this->id)->whereHas('tags', function ($query) {
            $query->whereIn('slug', $this->tags()->get()->pluck('slug')->toArray());
        })
        ->inRandomOrder()
        ->limit(3)
        ->get();
    }

public function shareFacebook()
{
    $event = Event::find($this->event_id);

    return '<a class="btn btn-sm btn-link"  href="https://www.facebook.com/sharer/sharer.php?u='.config('app.url').'/article/show/'.$this->slug.'" data-toggle="tooltip" target="_blank" title="Share to facebook"><i class="la la-facebook"></i>    </a>';
}

public function shareTwitter()
{
    $event = Event::find($this->event_id);

    return '<a class="btn btn-sm btn-link"  href="https://twitter.com/intent/tweet?text='.config('app.url').'/article/show/'.$this->slug.'" data-toggle="tooltip" target="_blank" title="Share to facebook"><i class="la la-twitter"></i>    </a>';
}

    public function categoryArticles($number = 5)
    {
        // dd('asd');
        // return  Article::where('id', '!=', $this->id )->whereHas('article_categories', function ($query)  {
        //     $query->whereIn('slug', $this->article_categories()->get()->pluck('slug')->toArray());
        // })
        // ->inRandomOrder()
        // ->limit(3)
        // ->get();
    }

    public function setPublishedDateAttribute($value)
    {
        $this->attributes['published_date'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    }

    public function getPublishedDateAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
    }

    public function getImageAttribute($value)
    {
        return $this->getFirstMediaUrl('article', 'main-image');
    }

    public function setImageAttribute($value)
    {
        if ($value == null) {
            $this->media()->delete();
        }

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            return false;
        }

        $this->media()->delete();

        $this->addMediaFromBase64($value)
            ->toMediaCollection('article');

        $this->media();
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

    protected static function booted()
    {
        static::creating(function ($model) {
            if ($model->slug == '') {
                return;
            }

            $model->slug = Str::slug($model->slug);
        });

        static::updating(function ($model) {
            $article = Article::find($model->id);
            if ($model->title !== $article->title) {
                $model->slug = $article->slug;
            } else {
                $model->slug = Str::slug($model->slug);
            }
        });
    }
}
