<?php

namespace App\Http\Requests;

use App\Models\Puranalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePuranaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('puranalu_edit');
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
