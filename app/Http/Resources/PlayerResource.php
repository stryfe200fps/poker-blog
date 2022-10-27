<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
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
            'name' => $this->name,
            'pseudonym' => $this->pseudonym,
            'avatar' => $this->avatar,
            'country' => $this->country?->name,
            'flag' => $this->country?->iso_3166_2,
        ];
    }
}
