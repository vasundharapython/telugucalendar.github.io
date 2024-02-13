<?php

namespace App\Http\Requests;

use App\Models\Sthotralu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSthotraluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sthotralu_edit');
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
