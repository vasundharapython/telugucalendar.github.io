<?php

namespace App\Http\Requests;

use App\Models\VedasukthuluCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVedasukthuluCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vedasukthulu_category_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
