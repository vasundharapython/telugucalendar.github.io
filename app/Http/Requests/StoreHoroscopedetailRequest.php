<?php

namespace App\Http\Requests;

use App\Models\Horoscopedetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHoroscopedetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('horoscopedetail_create');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'required',
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time_of_birth' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'place_of_birth' => [
                'string',
                'required',
            ],
            'problem_details' => [
                'required',
            ],
            'contact_details' => [
                'string',
                'required',
            ],
        ];
    }
}
