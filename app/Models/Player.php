<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Player extends Model implements HasMedia
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar')
            ->width(800)
            ->height(800)
            ->nonQueued();
    }

    protected $guarded = ['id'];

    public function getAvatarAttribute($value)
    {
        return $this->getFirstMediaUrl('player', 'avatar');
    }

    public function setAvatarAttribute($value)
    {
        if ($value == null) {
            $this->media()->delete();
        }

        if (preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $value) == 0) {
            return false;
        }

        $this->media()->delete();
        $this->addMediaFromBase64($value)
            ->toMediaCollection('player');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function openHistory()
    {
        return '<a class="btn btn-sm btn-link"  href="player_history/'.urlencode($this->attributes['id']).'" data-toggle="tooltip" title="Chip  Count"><i class="fa fa-search"></i> history  </a>';
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    protected static function booted()
    {
        static::deleting(function ($deletePlayer) {
            $eventChip = EventChip::where('player_id', $deletePlayer->id)->get();

            if ($eventChip->count()) {
                \Alert::add('error', 'This is a red bubble.');

                return back();
            }

            foreach ($eventChip as $chip) {
                $chip->delete();
            }
        });

        static::created(function ($player) {
            Tag::create([
                'title' => ucwords($player->name),
            ]);
        });
    }
}
