<?php

namespace App\Traits;


use Carbon\Carbon;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

trait Prunable
{
    public function prunable()
    {
        $thins = static::where('created_at', '<=', now()->subDays(2));
        dd($things->get());
    }

    protected function pruning()
    {
        dump('yeah can');
    }
}
