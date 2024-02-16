<?php

namespace App\Http\Requests;

use App\Models\Onlinepujadetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOnlinepujadetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('onlinepujadetail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:onlinepujadetails,id',
        ];
    }
}
