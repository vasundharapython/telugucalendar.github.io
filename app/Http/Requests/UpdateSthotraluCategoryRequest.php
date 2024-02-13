<?php

namespace App\Http\Requests;

use App\Models\SthotraluCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSthotraluCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sthotralu_category_edit');
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
