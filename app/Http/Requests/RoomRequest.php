<?php

namespace App\Http\Requests;

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
            'features' => function($attribute, $value, $fail) {
                // dd(json_decode($value));
                  $fieldGroups = $value;
                  // allow repeatable field group to be empty
                  if ($fieldGroups === null || count($fieldGroups) == 0) {
                    return true;
                  }

                  // run through each field group inside the repeatable field
                  // and run a custom validation for it
                  foreach ($fieldGroups as $key => $group) {
                        $fieldGroupValidator = Validator::make((array)$group, [
                            'feature' => 'required',
                        ]);

                        if ($fieldGroupValidator->fails())
                        {
                            // dd($fieldGroupValidator->errors());
                            return $fail('One of the entries in the '.$attribute.' is invalid.');
                        }
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


        ];
    }
}
