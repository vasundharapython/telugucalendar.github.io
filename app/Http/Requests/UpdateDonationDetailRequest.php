<?php

namespace App\Http\Requests;

use App\Models\DonationDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDonationDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('donation_detail_edit');
    }

    public function rules()
    {
        return [];
    }
}
