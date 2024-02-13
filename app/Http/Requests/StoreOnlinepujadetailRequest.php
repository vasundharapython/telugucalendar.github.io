<?php

namespace App\Http\Requests;

use App\Models\Onlinepujadetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOnlinepujadetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('onlinepujadetail_create');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'required',
            ],
            'place_of_program' => [
                'string',
                'nullable',
            ],
            'date_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'contact_details' => [
                'string',
                'nullable',
            ],
        ];
    }
}
