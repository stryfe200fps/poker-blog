<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class EventReportRequest extends FormRequest
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
            'title' => [
                'required',
            ],
            'slug' => 'unique:event_reports,slug,'.\Request::get('id'),
            'type' => 'required',

            'level' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->slug !== null) {
            $this->merge([
                'slug' => Str::slug($this->slug),
            ]);
        }

        // dd($this->slug);
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
            'title.required' => 'Title is required',
            'level.required' => 'Level is required',
        ];
    }
}
