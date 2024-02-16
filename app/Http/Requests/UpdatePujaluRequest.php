<?php

namespace App\Http\Requests;

use App\Models\Pujalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePujaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pujalu_edit');
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
