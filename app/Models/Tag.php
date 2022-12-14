<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use App\Traits\RecordSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use RecordSlug;

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

}
