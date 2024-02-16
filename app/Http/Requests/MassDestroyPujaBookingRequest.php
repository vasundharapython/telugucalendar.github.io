<?php

namespace App\Http\Requests;

use App\Models\PujaBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPujaBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('puja_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:puja_bookings,id',
        ];
    }
}
