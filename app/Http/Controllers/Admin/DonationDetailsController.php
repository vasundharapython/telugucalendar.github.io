<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDonationDetailRequest;
use App\Http\Requests\StoreDonationDetailRequest;
use App\Http\Requests\UpdateDonationDetailRequest;
use App\Models\DonationDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DonationDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('donation_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DonationDetail::query()->select(sprintf('%s.*', (new DonationDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'donation_detail_show';
                $editGate      = 'donation_detail_edit';
                $deleteGate    = 'donation_detail_delete';
                $crudRoutePart = 'donation-details';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->editColumn('contact_details', function ($row) {
                return $row->contact_details ? $row->contact_details : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.donationDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('donation_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donationDetails.create');
    }

    public function store(StoreDonationDetailRequest $request)
    {
        $donationDetail = DonationDetail::create($request->all());

        return redirect()->route('admin.donation-details.index');
    }

    public function edit(DonationDetail $donationDetail)
    {
        abort_if(Gate::denies('donation_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donationDetails.edit', compact('donationDetail'));
    }

    public function update(UpdateDonationDetailRequest $request, DonationDetail $donationDetail)
    {
        $donationDetail->update($request->all());

        return redirect()->route('admin.donation-details.index');
    }

    public function show(DonationDetail $donationDetail)
    {
        abort_if(Gate::denies('donation_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donationDetails.show', compact('donationDetail'));
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
