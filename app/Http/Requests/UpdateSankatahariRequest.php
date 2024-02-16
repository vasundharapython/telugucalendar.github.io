<?php

namespace App\Http\Requests;

use App\Models\Sankatahari;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSankatahariRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sankatahari_edit');
    }

    public function rules()
    {
        return [
            'month' => [
                'string',
                'nullable',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
