<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
<<<<<<<< HEAD:app/Models/Content.php
    use HasFactory;
========
>>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32:app/Models/ArticleTag.php

    protected $guarded = [
        'id'
    ];
}
