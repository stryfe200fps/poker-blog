<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPayout extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['prize', 'event_id', 'player_id', 'position'];

    public $excelHeaders = ['prize', 'player_id', 'position'];
    public $group = ['event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class)->with('country');
    }
}
