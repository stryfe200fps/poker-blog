<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use App\Observers\DefaultModelObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];
    use HasMediaCollection, HasMultipleImages;

    public $mediaCollection = 'banner';

    public static function boot()
    {
        parent::boot();
        self::observe(new DefaultModelObserver);
    }
}
