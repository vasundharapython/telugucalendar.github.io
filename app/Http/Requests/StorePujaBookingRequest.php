<?php

namespace App\Http\Requests;

use App\Models\PujaBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePujaBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('puja_booking_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'gotram' => [
                'string',
                'required',
            ],
            'phone_no' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
            ],
            'address' => [
                'required',
            ],
        ];
    }
}
