<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      $modelGeneratedConversions =   collect($this->generated_conversions)->map(fn ($conversion, $key) => 
      $this?->getUrl($key) ?? ''
    )->toArray() ?? [];

    return array_merge( $modelGeneratedConversions, [ 'og_image' => $this->getUrl() ] );
    }
}
