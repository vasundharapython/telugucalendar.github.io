<?php

namespace App\Http\Requests;

use App\Models\SevaDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSevaDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('seva_detail_edit');
    }

    public function rules()
    {
        return [];
    }
}
