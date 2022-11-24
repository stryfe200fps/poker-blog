<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use App\Traits\RecordMedia;
use App\Traits\RecordSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategory extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;

    use RecordSlug, RecordMedia;

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




    
}
