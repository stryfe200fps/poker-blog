<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Sluggable\HasSlug;
use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasMediaCollection;
use App\Observers\SlugObserver;
use App\Observers\MediaObserver;
use App\Observers\ModelTaggableObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model implements HasMedia
{
    // use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;
    use HasMediaCollection;
    use HasMultipleImages;

    public bool $shouldResizeImage = true;

    protected $casts = [
        'content' => 'json',
    ];

    public $mediaCollection = 'article';

    public static function boot()
    {
        parent::boot();
        self::observe(new SlugObserver());
        self::observe(new MediaObserver());
        self::observe(new ModelTaggableObserver());
    }

    public function resetContentHtml($content)
    {
        $pattern = '/<span translate="no">/i';
        $fPattern = '/<\/span>/i';
        $reset1 = preg_replace($pattern, '', $content);
        $reset2 = preg_replace($fPattern, '', $content);
    }

    public function getContentAttribute($content)
    {
        $array = json_decode($content);
        array_shift($array);
        return $array;
    }

    public function getFirstContentAttribute()
    {
        $array = json_decode($this->attributes['content']);
        return $array[0];
    }

    public function getOptionalContentAttribute()
    {
        $array = json_decode($this->attributes['content']);
        if (count($array) <= 1) {
            return [];
        }

        array_shift($array);
        return $array[0];
    }

    public function getCustomContentAttribute()
    {
        return json_decode($this->attributes['content']);
    }

    public function getMainContentAttribute()
    {
        $array = json_decode($this->attributes['content']);
        return $array[0]->body;
    }

    // public function setContentAttribute($content)
    // {
    //     $new = collect($content)->map(function ($item, $key) {
    //         $item['body'] = '<div class="content" id="content'.$key.'">'.$item['body'].'</div>';
    //         return $item;
    //     });

    //     $this->attributes['content'] = json_encode($new->toArray());
    // }

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
        return '<a class="btn btn-sm btn-link"  href="https://www.facebook.com/sharer/sharer.php?u=' . config('app.url') . '/news/year/month/' . $this->slug . '" data-toggle="tooltip" target="_blank" title="Share to facebook"><i class="la la-facebook"></i>    </a>';
    }

    public function shareTwitter()
    {
        return '<a class="btn btn-sm btn-link"  href="https://twitter.com/intent/tweet?text=' . config('app.url') . '/news/year/month/' . $this->slug . '" data-toggle="tooltip" target="_blank" title="Share to facebook"><i class="la la-twitter"></i>    </a>';
    }


    public function setPublishedDateAttribute($value)
    {
        $this->attributes['published_date'] = Carbon::parse($value, session()->get('timezone') ?? 'UTC')->setTimezone('UTC');
    }

    public function getPublishedDateAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(session()->get('timezone') ?? 'UTC');
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
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article_categories()
    {
        return $this->belongsToMany(ArticleCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
