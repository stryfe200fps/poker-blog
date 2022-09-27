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

    public function live_reports()
    {
        return $this->hasMany(EventReport::class);
    }

    public function getNameAttribute()
    {
        return 'Level '. $this->attributes['level'] . ' - '.  $this->attributes['name']  ;
    }

    // public function getNameAttribute()
    // {
    //     return  $this->attributes['name'];
    // }
}
