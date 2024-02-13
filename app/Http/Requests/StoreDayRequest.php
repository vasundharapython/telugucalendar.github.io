<?php

namespace App\Http\Requests;

use App\Models\Day;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDayRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('day_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'suryodayam' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'suryastamam' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'thidhi' => [
                'string',
                'required',
            ],
            'nakshatram' => [
                'string',
                'required',
            ],
            'rahukalam' => [
                'string',
                'required',
            ],
            'yamagandam' => [
                'string',
                'required',
            ],
            'durmuhurtham' => [
                'string',
                'required',
            ],
            'varjyamu' => [
                'string',
                'required',
            ],
            'heading' => [
                'string',
                'nullable',
            ],
        ];
    }
}
