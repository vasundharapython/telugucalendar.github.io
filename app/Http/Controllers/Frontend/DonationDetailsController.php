<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDonationDetailRequest;
use App\Http\Requests\StoreDonationDetailRequest;
use App\Models\DonationDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonationDetailsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('donation_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donationDetails = DonationDetail::all();

        return view('frontend.donationDetails.index', compact('donationDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('donation_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.donationDetails.create');
    }

    public function store(StoreDonationDetailRequest $request)
    {
        $donationDetail = DonationDetail::create($request->all());

        return redirect()->route('frontend.donation-details.index');
    }

    public function destroy(DonationDetail $donationDetail)
    {
        abort_if(Gate::denies('donation_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donationDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyDonationDetailRequest $request)
    {
        $donationDetails = DonationDetail::find(request('ids'));

        foreach ($donationDetails as $donationDetail) {
            $donationDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
