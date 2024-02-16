<?php

namespace App\Http\Requests;

use App\Models\SevaDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySevaDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('seva_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:seva_details,id',
        ];
    }
}
