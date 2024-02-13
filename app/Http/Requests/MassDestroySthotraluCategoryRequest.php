<?php

namespace App\Http\Requests;

use App\Models\SthotraluCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySthotraluCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sthotralu_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sthotralu_categories,id',
        ];
    }
}
