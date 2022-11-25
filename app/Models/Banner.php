<?php

namespace App\Models;

use App\Traits\HasMultipleImages;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasMediaCollection;
use App\Traits\RecordMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public bool $shouldOptimizeImage = false;
    public bool $shouldResizeImage = false;

    protected $guarded = ['id'];
    use HasMediaCollection, HasMultipleImages;

    use RecordMedia;

    public $mediaCollection = 'banner';

    
}
