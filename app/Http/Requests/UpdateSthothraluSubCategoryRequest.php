<?php

namespace App\Http\Requests;

use App\Models\SthothraluSubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSthothraluSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sthothralu_sub_category_edit');
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
