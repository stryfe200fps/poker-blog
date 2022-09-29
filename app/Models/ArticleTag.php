<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    protected $guarded = [

        'id',


    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
