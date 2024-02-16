<?php

namespace App\Http\Requests;

use App\Models\SevaDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSevaDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('seva_detail_create');
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
