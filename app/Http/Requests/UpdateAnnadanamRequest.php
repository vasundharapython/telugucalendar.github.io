<?php

namespace App\Http\Requests;

use App\Models\Annadanam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAnnadanamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('annadanam_edit');
    }

    public function rules()
    {
        return [
            'occasion' => [
                'string',
                'required',
            ],
            'full_name' => [
                'string',
                'required',
            ],
            'gotram' => [
                'string',
                'required',
            ],
            'star' => [
                'string',
                'required',
            ],
            'residence' => [
                'string',
                'required',
            ],
            'contact_details' => [
                'string',
                'required',
            ],
            'date' => [
                'required',
            ],
            'email' => [
                'required',
            ],
        ];
    }
}
