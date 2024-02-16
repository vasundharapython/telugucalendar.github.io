<?php

namespace App\Http\Requests;

use App\Models\JobApplication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateJobApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_application_edit');
    }

    public function rules()
    {
        return [];
    }
}
