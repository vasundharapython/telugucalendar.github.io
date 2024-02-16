<?php

namespace App\Http\Requests;

use App\Models\Bhagavathgeetha;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBhagavathgeethaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bhagavathgeetha_edit');
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
