<?php

namespace App\Http\Requests;

use App\Models\SthotraluCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSthotraluCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sthotralu_category_create');
    }

    public function rules()
    {
        return [
            'category' => [
                'string',
                'required',
            ],
        ];
    }
}
