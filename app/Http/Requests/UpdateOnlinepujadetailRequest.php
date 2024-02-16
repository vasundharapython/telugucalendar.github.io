<?php

namespace App\Http\Requests;

use App\Models\Onlinepujadetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOnlinepujadetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('onlinepujadetail_edit');
    }

    public function rules()
    {
        return [];
    }
}
