<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Level extends Model
{
    protected $guarded = ['id'];

    use CrudTrait;
    use HasFactory;

    public function event_reports()
    {
        return $this->hasMany(EventReport::class);
    }

    public function getLevelAttribute()
    {
        return 'Level '. $this->attributes['level'] . ' - Blinds '.  $this->attributes['blinds'] . '/'. $this->attributes['ante'] . ' ante '. $this->attributes['ante']   ;
    }

    // public function getNameAttribute()
    // {
    //     return  $this->attributes['name'];
    // }
}
