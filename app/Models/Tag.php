<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


    // public function tags()
    // {
    //     return $this->morphToMany(Tag::class, 'taggable');
    // }
}
