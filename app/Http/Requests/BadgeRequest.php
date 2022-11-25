<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

<<<<<<< HEAD
<<<<<<<< HEAD:app/Http/Requests/BadgeRequest.php
class BadgeRequest extends FormRequest
========
class MediaReportingCategoryRequest extends FormRequest
>>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32:app/Http/Requests/MediaReportingCategoryRequest.php
=======
<<<<<<<< HEAD:app/Http/Requests/MediaReportingCategoryRequest.php
class MediaReportingCategoryRequest extends FormRequest
========
class BadgeRequest extends FormRequest
>>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32:app/Http/Requests/BadgeRequest.php
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            'title' => 'required',
=======
            'title' => 'required'
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
<<<<<<< HEAD
            //
=======
<<<<<<<< HEAD:app/Http/Requests/MediaReportingCategoryRequest.php
            'title.required' => 'Title is required'
========
            //
>>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32:app/Http/Requests/BadgeRequest.php
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        ];
    }
}
