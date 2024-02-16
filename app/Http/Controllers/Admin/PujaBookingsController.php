<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPujaBookingRequest;
use App\Http\Requests\StorePujaBookingRequest;
use App\Http\Requests\UpdatePujaBookingRequest;
use App\Models\PujaBooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PujaBookingsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('puja_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PujaBooking::query()->select(sprintf('%s.*', (new PujaBooking)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'puja_booking_show';
                $editGate      = 'puja_booking_edit';
                $deleteGate    = 'puja_booking_delete';
                $crudRoutePart = 'puja-bookings';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('gotram', function ($row) {
                return $row->gotram ? $row->gotram : '';
            });
            $table->editColumn('phone_no', function ($row) {
                return $row->phone_no ? $row->phone_no : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('requirement_of_puja', function ($row) {
                return $row->requirement_of_puja ? $row->requirement_of_puja : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.pujaBookings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('puja_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pujaBookings.create');
    }

    public function store(StorePujaBookingRequest $request)
    {
        $pujaBooking = PujaBooking::create($request->all());

        return redirect()->route('admin.puja-bookings.index');
    }

    public function edit(PujaBooking $pujaBooking)
    {
        abort_if(Gate::denies('puja_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pujaBookings.edit', compact('pujaBooking'));
    }

    public function update(UpdatePujaBookingRequest $request, PujaBooking $pujaBooking)
    {
        $pujaBooking->update($request->all());

        return redirect()->route('admin.puja-bookings.index');
    }

    public function show(PujaBooking $pujaBooking)
    {
        abort_if(Gate::denies('puja_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pujaBookings.show', compact('pujaBooking'));
    }

    public function destroy(PujaBooking $pujaBooking)
    {
        abort_if(Gate::denies('puja_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pujaBooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyPujaBookingRequest $request)
    {
        $pujaBookings = PujaBooking::find(request('ids'));

        foreach ($pujaBookings as $pujaBooking) {
            $pujaBooking->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
