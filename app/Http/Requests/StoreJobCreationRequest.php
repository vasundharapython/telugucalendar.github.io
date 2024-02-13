<?php

namespace App\Http\Requests;

use App\Models\JobCreation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobCreationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_creation_create');
    }

    public function rules()
    {
        return [
            'job' => [
                'string',
                'nullable',
            ],
            'location' => [
                'string',
                'nullable',
            ],
        ];
    }
}
