<?php

namespace App\Http\Requests;

use App\Models\Muhurthambooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMuhurthambookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('muhurthambooking_edit');
    }

    public function rules()
    {
        return [];
    }
}
