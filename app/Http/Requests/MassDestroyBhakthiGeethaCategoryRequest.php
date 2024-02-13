<?php

namespace App\Http\Requests;

use App\Models\BhakthiGeethaCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBhakthiGeethaCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bhakthi_geetha_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bhakthi_geetha_categories,id',
        ];
    }
}