<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use CrudTrait;
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id',
    ];

    public function fullName()
    {
        return $this->full_name;
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function tournaments()
    {
        return $this->hasMany(Tournament::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
