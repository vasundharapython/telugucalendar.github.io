<?php

namespace App\Http\Requests;

use App\Models\MonthMi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMonthMiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('month_mi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:month_mis,id',
        ];
    }
}
