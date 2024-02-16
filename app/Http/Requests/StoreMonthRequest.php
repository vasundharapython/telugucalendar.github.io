<?php

namespace App\Http\Requests;

use App\Models\Month;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMonthRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('month_create');
    }

    public function rules()
    {
        return [
            'month_id' => [
                'required',
                'string',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'heading' => [
                'string',
                'nullable',
            ],
            'pandugalu' => [
                'string',
                'nullable',
            ],
            'govtselavu' => [
                'string',
                'nullable',
            ],
            'upavasalu' => [
                'string',
                'nullable',
            ],
            'importantdays' => [
                'string',
                'nullable',
            ],
        ];
    }
}
