<?php

namespace App\Http\Requests;

use App\Models\DonationDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDonationDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('donation_detail_create');
    }

    public function rules()
    {
        return [
            'full_name' => [
                'string',
                'nullable',
            ],
            'contact_details' => [
                'string',
                'nullable',
            ],
        ];
    }
}
