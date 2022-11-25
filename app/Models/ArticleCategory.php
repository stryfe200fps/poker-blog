<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
<<<<<<< HEAD
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
=======
use App\Observers\DefaultModelObserver;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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

    public static function boot()
    {
        parent::boot();
<<<<<<< HEAD
        self::observe(new SlugObserver);
        self::observe(new MediaObserver);
=======
        self::observe(new DefaultModelObserver);
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    }


    
}
