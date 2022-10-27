<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'level' => $this->level,
            'level_value' => $this->level_value,
            'blinds' => $this->blinds,
            'ante' => $this->ante,
        ];
    }
}
