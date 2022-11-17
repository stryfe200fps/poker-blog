<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];

    public function getSymbolAttribute($value)
    {
        $get = $this->title;

        return $get;
    }
}
