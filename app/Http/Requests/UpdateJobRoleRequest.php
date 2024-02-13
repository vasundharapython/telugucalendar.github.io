<?php

namespace App\Http\Requests;

use App\Models\JobRole;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobRoleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_role_edit');
    }

    public function rules()
    {
        return [
            'job_category_id' => [
                'required',
                'integer',
            ],
            'job_role' => [
                'string',
                'required',
            ],
        ];
    }
}
