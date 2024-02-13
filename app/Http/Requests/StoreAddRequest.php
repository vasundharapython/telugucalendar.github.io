<?php

namespace App\Http\Requests;

use App\Models\Add;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_create');
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