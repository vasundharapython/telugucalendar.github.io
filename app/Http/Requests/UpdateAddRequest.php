<?php

namespace App\Http\Requests;

use App\Models\Add;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAddRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_edit');
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
