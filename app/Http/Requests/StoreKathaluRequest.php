<?php

namespace App\Http\Requests;

use App\Models\Kathalu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKathaluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kathalu_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
