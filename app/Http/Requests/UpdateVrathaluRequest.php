<?php

namespace App\Http\Requests;

use App\Models\Vrathalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVrathaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vrathalu_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
