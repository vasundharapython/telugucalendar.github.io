<?php

namespace App\Http\Requests;

use App\Models\Bhagavathgeetha;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBhagavathgeethaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bhagavathgeetha_create');
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
