<?php

namespace App\Http\Resources;

<<<<<<< HEAD
use Backpack\Settings\app\Models\Setting;
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
<<<<<<< HEAD
            'xs_image' => $urlPath . '?w='. Setting::get('xs_image_width')  ?? config('app.xs-image')[0].'&h='. Setting::get('xs_image_height') ?? config('app.xs-image')[1] ,
            'sm_image' => $urlPath . '?w='. Setting::get('sm_image_width') ?? config('app.sm-image')[0].'&h='. Setting::get('sm_image_height') ?? config('app.sm-image')[1] ,
            'md_image' => $urlPath . '?w='. Setting::get('md_image_width') ?? config('app.md-image')[0].'&h='. Setting::get('md_image_height') ?? config('app.md-image')[1] ,
            'lg_image' => $urlPath . '?w='. Setting::get('lg_image_width') ??  config('app.lg-image')[0].'&h='. Setting::get('lg_image_height') ?? config('app.lg-image')[1] ,
            'xl_image' => $urlPath . '?w='. Setting::get('xl_image_width') ?? config('app.xl-image')[0].'&h='. Setting::get('xl_image_height') ?? config('app.xl-image')[1] ,
=======
            'xs_image' => $urlPath . '?w='.config('app.xs-image')[0].'&h='. config('app.xs-image')[1] ,
            'sm_image' => $urlPath . '?w='.config('app.sm-image')[0].'&h='. config('app.sm-image')[1] ,
            'md_image' => $urlPath . '?w='.config('app.md-image')[0].'&h='. config('app.md-image')[1] ,
            'lg_image' => $urlPath . '?w='.config('app.lg-image')[0].'&h='. config('app.lg-image')[1] ,
            'xl_image' => $urlPath . '?w='.config('app.xl-image')[0].'&h='. config('app.xl-image')[1] ,
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
            'og_image' => $urlPath
        ];
    }
}
