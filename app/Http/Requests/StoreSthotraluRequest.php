<?php

namespace App\Http\Requests;

use App\Models\Sthotralu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSthotraluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sthotralu_create');
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
                'nullable',
            ],
        ];
    }
}
