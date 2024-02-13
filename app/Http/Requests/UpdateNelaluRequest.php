<?php

namespace App\Http\Requests;

use App\Models\Nelalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNelaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('nelalu_edit');
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
