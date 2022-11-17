<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'article_categories' => 'required',
            'published_date' => 'required',
            'author_id' => 'required',
            'slug' =>  [ Rule::unique('articles')->ignore(request()->get('id'))], 
            'content' => function($attribute, $value, $fail) {
                  $fieldGroups = $value;
                  if ($fieldGroups === null || count($fieldGroups) == 0) 
                    return true;

                  foreach ($fieldGroups as $key => $group) {
                        $fieldGroupValidator = Validator::make((array)$group, [
                            'title' => 'required',
                            'body' => 'required',
                        ]);

                        if ($fieldGroupValidator->fails())
                            return $fail('One of the entries in the '.$attribute.' is invalid.');
                   }
               }
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
            'article_categories.required' => 'Category is required',
            'published_date.required' => 'Published date is required',
            'author_id.required' => 'Author is required',
            'slug.unique' => 'Slug is unique',
        ];
    }
}
