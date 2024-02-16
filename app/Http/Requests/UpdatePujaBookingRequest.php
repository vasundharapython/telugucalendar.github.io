<?php

namespace App\Http\Requests;

use App\Models\PujaBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePujaBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('puja_booking_edit');
    }

    public function rules()
    {
        return [];
    }
}
