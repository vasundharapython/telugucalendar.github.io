<?php

namespace App\Http\Requests;

use App\Models\SthothraluSubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSthothraluSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sthothralu_sub_category_create');
    }

    public function rules()
    {
        return [
            'subcategory_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
