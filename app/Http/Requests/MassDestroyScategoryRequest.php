<?php

namespace App\Http\Requests;

use App\Models\Scategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyScategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('scategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:scategories,id',
        ];
    }
}
