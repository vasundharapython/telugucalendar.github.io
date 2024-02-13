<?php

namespace App\Http\Requests;

use App\Models\Muhurthalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMuhurthaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('muhurthalu_create');
    }

    public function rules()
    {
        return [
            'month_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'muhurtham' => [
                'string',
                'nullable',
            ],
        ];
    }
}
