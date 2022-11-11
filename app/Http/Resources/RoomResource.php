<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'content' => $this->content,
            'country' => new CountryResource($this->country),
            'features' => $this->features,
            'address' => $this->address,
            'phone' => $this->phone,
            'website' => $this->website,
            'email' => $this->email,
            'image_set' => $this->allMedia()
        ];
    }
}
