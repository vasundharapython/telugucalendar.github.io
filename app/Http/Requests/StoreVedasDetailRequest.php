<?php

namespace App\Http\Requests;

use App\Models\VedasDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVedasDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vedas_detail_create');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'nullable',
            ],
            'contact_details' => [
                'string',
                'nullable',
            ],
        ];
    }
}
