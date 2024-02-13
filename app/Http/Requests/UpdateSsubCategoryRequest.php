<?php

namespace App\Http\Requests;

use App\Models\SsubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSsubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ssub_category_edit');
    }

    public function rules()
    {
        return [
            'scategory_id' => [
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
