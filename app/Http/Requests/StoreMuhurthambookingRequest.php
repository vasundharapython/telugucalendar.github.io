<?php

namespace App\Http\Requests;

use App\Models\Muhurthambooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMuhurthambookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('muhurthambooking_create');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'required',
            ],
            'spouse_name' => [
                'string',
                'required',
            ],
            'stars' => [
                'string',
                'required',
            ],
            'seeking_muhurtham' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'place_of_muhurtham' => [
                'string',
                'required',
            ],
            'contact_details' => [
                'string',
                'required',
            ],
        ];
    }
}
