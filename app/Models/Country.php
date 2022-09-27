<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use CrudTrait;
    use HasFactory;

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
}
