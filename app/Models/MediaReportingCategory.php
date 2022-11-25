<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Observers\MediaObserver;
use App\Observers\SlugObserver;
use App\Traits\RecordMedia;
use App\Traits\RecordSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MediaReportingCategory extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasSlug;
    use RecordSlug, RecordMedia;

    protected $guarded = ['id'];


    public function media_reportings()
    {
        return $this->belongsToMany(MediaReporting::class);
    }

    
}
