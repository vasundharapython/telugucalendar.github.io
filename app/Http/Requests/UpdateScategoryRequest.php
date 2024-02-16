<?php

namespace App\Http\Requests;

use App\Models\Scategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateScategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('scategory_edit');
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
