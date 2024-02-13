<?php

namespace App\Http\Requests;

use App\Models\Bhakthigeetam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBhakthigeetamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bhakthigeetam_edit');
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}