<?php

namespace App\Http\Requests;

use App\Models\Annadanam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAnnadanamRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('annadanam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:annadanams,id',
        ];
    }
}
