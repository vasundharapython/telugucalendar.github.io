<?php

namespace App\Http\Requests;

use App\Models\Sankalpalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSankalpaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sankalpalu_edit');
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
