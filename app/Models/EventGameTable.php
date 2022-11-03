<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGameTable extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $guarded = [
        'id'
    ];


    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // public function tournament()
    // {
    //     return $this->hasManyThrough(Tournament::class, Event::class);
    // }

}
