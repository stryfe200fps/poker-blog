<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $guarded = ['id'];

    protected $appends = [
        'level_value',
    ];

    use CrudTrait;
    use HasFactory;

    public function event_reports()
    {
        return $this->hasMany(EventReport::class);
    }

    public function getLevelValueAttribute()
    {
        return 'Level '.$this->attributes['level'].' - Blinds '.$this->attributes['small_blinds'].' - '.$this->attributes['big_blinds'].', '.$this->attributes['ante'].' ante';
    }

    public function getBlindsAttribute()
    {
        return $this->attributes['small_blinds'].'/'.$this->attributes['big_blinds'];
    }
}
