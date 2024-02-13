<?php

namespace App\Http\Requests;

use App\Models\Vrathalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVrathaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vrathalu_create');
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
