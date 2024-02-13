<?php

namespace App\Http\Requests;

use App\Models\SthothraluCopy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySthothraluCopyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sthothralu_copy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sthothralu_copies,id',
        ];
    }
}
