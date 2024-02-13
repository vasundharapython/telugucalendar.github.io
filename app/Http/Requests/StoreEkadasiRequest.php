<?php

namespace App\Http\Requests;

use App\Models\Ekadasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEkadasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ekadasi_create');
    }

    public function rules()
    {
        return [
            'month' => [
                'string',
                'nullable',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
