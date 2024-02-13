<?php

namespace App\Http\Requests;

use App\Models\SthothraluSubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySthothraluSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sthothralu_sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sthothralu_sub_categories,id',
        ];
    }
}
