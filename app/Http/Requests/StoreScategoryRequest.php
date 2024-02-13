<?php

namespace App\Http\Requests;

use App\Models\Scategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreScategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('scategory_create');
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
