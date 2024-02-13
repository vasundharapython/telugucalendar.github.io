<?php

namespace App\Http\Requests;

use App\Models\SthothraluCopy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSthothraluCopyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sthothralu_copy_create');
    }

    public function rules()
    {
        return [
            'ssubcategory_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
