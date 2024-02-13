<?php

namespace App\Http\Requests;

use App\Models\DonationDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDonationDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('donation_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:donation_details,id',
        ];
    }
}
