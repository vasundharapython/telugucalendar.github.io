<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonationDetailRequest;
use App\Http\Resources\Admin\DonationDetailResource;
use App\Models\DonationDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonationDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('donation_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DonationDetailResource(DonationDetail::all());
    }

    public function store(StoreDonationDetailRequest $request)
    {
        $donationDetail = DonationDetail::create($request->all());

        return (new DonationDetailResource($donationDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(DonationDetail $donationDetail)
    {
        abort_if(Gate::denies('donation_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donationDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
