<?php

namespace App\Http\Requests;

use App\Models\MonthMi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMonthMiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('month_mi_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'rahukalam' => [
                'string',
                'nullable',
            ],
            'yamagandam' => [
                'string',
                'nullable',
            ],
            'durmuhurtham' => [
                'string',
                'nullable',
            ],
            'thidhi' => [
                'string',
                'nullable',
            ],
            'nakshatram' => [
                'string',
                'nullable',
            ],
            'varjyam' => [
                'string',
                'nullable',
            ],
        ];
    }
}
