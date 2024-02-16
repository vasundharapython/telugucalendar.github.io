<?php

namespace App\Http\Requests;

use App\Models\JobCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_category_create');
    }

    public function rules()
    {
        return [
            'category' => [
                'string',
                'required',
            ],
        ];
    }
}
