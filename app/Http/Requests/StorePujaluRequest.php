<?php

namespace App\Http\Requests;

use App\Models\Pujalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePujaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pujalu_create');
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
