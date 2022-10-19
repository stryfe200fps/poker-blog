<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Day extends Model implements HasMedia
{
    use InteractsWithMedia;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('main-gallery-thumb')
            ->width(130)
            ->height(86);

        $this->addMediaConversion('main-gallery');
    }

    public function openReport($crud = false)
    {
        return '<a class="btn btn-sm btn-link"  href="report?day='.urlencode($this->attributes['id']).'&event='.urlencode($this->attributes['event_id']).'" data-toggle="tooltip" title="Days"><i class="fa fa-search"></i> Report  </a>';
    }

    public function event_reports()
    {
        return $this->hasMany(EventReport::class);
    }

    public function report_count()
    {
        return $this->event_reports()->count();
    }

    public function event_chips()
    {
        return $this->hasMany(EventChip::class);
    }

}
