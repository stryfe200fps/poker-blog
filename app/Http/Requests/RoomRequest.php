<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'slug' =>  Rule::unique('rooms')->ignore(request()->get('id')), 
            'features' => function($attribute, $value, $fail) {
                  $fieldGroups = $value;
                  if ($fieldGroups === null || count($fieldGroups) == 0) 
                    return true;

                  foreach ($fieldGroups as $key => $group) {
                        $fieldGroupValidator = Validator::make((array)$group, [
                            'feature' => 'required',
                        ]);

                        if ($fieldGroupValidator->fails())
                            return $fail('One of the entries in the '.$attribute.' is invalid.');
                   }
               },
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
            'title.required' => 'Title is required',
            'description.required' => 'description is required',
            'slug.unique' => 'Slug should be unique'
        ];
    }
}
