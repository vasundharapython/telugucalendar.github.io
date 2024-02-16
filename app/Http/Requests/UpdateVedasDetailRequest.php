<?php

namespace App\Http\Requests;

use App\Models\VedasDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVedasDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vedas_detail_edit');
    }

    public function rules()
    {
        return [];
    }
}
