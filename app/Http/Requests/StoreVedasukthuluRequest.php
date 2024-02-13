<?php

namespace App\Http\Requests;

use App\Models\Vedasukthulu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVedasukthuluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vedasukthulu_create');
    }

    public function rules()
    {
        return [
            'subcategory_id' => [
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
