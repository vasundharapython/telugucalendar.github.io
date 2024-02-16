<?php

namespace App\Http\Requests;

use App\Models\VedasukthuluSubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVedasukthuluSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vedasukthulu_sub_category_create');
    }

    public function rules()
    {
        return [
            'category_id' => [
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
