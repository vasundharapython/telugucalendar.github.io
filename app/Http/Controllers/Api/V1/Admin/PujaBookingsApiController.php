<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePujaBookingRequest;
use App\Http\Resources\Admin\PujaBookingResource;
use App\Models\PujaBooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PujaBookingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('puja_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PujaBookingResource(PujaBooking::all());
    }

    public function store(StorePujaBookingRequest $request)
    {
        $pujaBooking = PujaBooking::create($request->all());

        return (new PujaBookingResource($pujaBooking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(PujaBooking $pujaBooking)
    {
        abort_if(Gate::denies('puja_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pujaBooking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
