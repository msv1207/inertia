<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mainCategoryTitle' => 'required|max:255',
            'categoryTitle' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ];
    }
}
