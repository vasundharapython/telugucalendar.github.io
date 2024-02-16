<?php

namespace App\Http\Requests;

use App\Models\GodanamDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGodanamDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('godanam_detail_edit');
    }

    public function rules()
    {
        return [];
    }
}
