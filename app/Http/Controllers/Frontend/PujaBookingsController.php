<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPujaBookingRequest;
use App\Http\Requests\StorePujaBookingRequest;
use App\Models\PujaBooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PujaBookingsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('puja_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pujaBookings = PujaBooking::all();

        return view('frontend.pujaBookings.index', compact('pujaBookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('puja_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.pujaBookings.create');
    }

    public function store(StorePujaBookingRequest $request)
    {
        $pujaBooking = PujaBooking::create($request->all());

        return redirect()->route('frontend.puja-bookings.index');
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
