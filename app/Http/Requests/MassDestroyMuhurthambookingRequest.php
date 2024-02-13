<?php

namespace App\Http\Requests;

use App\Models\Muhurthambooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMuhurthambookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('muhurthambooking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:muhurthambookings,id',
        ];
    }
}
