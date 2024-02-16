<?php

namespace App\Http\Requests;

use App\Models\GodanamDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGodanamDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('godanam_detail_create');
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
