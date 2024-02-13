<?php

namespace App\Http\Requests;

use App\Models\JobApplication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_application_create');
    }

    public function rules()
    {
        return [
            'job' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'nullable',
            ],
            'phone_no' => [
                'string',
                'nullable',
            ],
        ];
    }
}
