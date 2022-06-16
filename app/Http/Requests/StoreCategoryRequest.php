<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'       => 'required|string|unique:categories',
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|integer',
        ];
    }
}
