<?php

namespace App\Http\Requests;

use App\Models\Horoscopedetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHoroscopedetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('horoscopedetail_edit');
    }

    public function rules()
    {
        return [];
    }
}
