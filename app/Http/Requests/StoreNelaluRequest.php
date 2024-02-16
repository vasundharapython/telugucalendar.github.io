<?php

namespace App\Http\Requests;

use App\Models\Nelalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNelaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('nelalu_create');
    }

    public function rules()
    {
        return [
            'month' => [
                'string',
                'required',
            ],
        ];
    }
}
