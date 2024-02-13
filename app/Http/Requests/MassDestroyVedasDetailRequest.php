<?php

namespace App\Http\Requests;

use App\Models\VedasDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVedasDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vedas_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:vedas_details,id',
        ];
    }
}
