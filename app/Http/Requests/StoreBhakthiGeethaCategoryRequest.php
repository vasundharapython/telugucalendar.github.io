<?php

namespace App\Http\Requests;

use App\Models\BhakthiGeethaCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBhakthiGeethaCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bhakthi_geetha_category_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}