<?php

namespace App\Http\Resources;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class CachedImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $urlPath = config('app.url') . "/api/images/$this->id";
        return [
            'xs_image' => $urlPath . '?w='. Setting::get('xs_image_width')  ?? config('app.xs-image')[0].'&h='. Setting::get('xs_image_height') ?? config('app.xs-image')[1] ,
            'sm_image' => $urlPath . '?w='. Setting::get('sm_image_width') ?? config('app.sm-image')[0].'&h='. Setting::get('sm_image_height') ?? config('app.sm-image')[1] ,
            'md_image' => $urlPath . '?w='. Setting::get('md_image_width') ?? config('app.md-image')[0].'&h='. Setting::get('md_image_height') ?? config('app.md-image')[1] ,
            'lg_image' => $urlPath . '?w='. Setting::get('lg_image_width') ??  config('app.lg-image')[0].'&h='. Setting::get('lg_image_height') ?? config('app.lg-image')[1] ,
            'xl_image' => $urlPath . '?w='. Setting::get('xl_image_width') ?? config('app.xl-image')[0].'&h='. Setting::get('xl_image_height') ?? config('app.xl-image')[1] ,
            'og_image' => $urlPath . '?w='. Setting::get('default_image_width') ?? config('app.xl-image')[0].'&h='. Setting::get('default_image_height') ?? config('app.xl-image')[1] ,
        ];
    }
}
