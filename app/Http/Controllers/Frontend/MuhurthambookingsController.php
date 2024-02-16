<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMuhurthambookingRequest;
use App\Http\Requests\StoreMuhurthambookingRequest;
use App\Models\Muhurthambooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MuhurthambookingsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('muhurthambooking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $muhurthambookings = Muhurthambooking::all();

        return view('frontend.muhurthambookings.index', compact('muhurthambookings'));
    }

    public function create()
    {
        abort_if(Gate::denies('muhurthambooking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.muhurthambookings.create');
    }

    public function store(StoreMuhurthambookingRequest $request)
    {
        $muhurthambooking = Muhurthambooking::create($request->all());

        return redirect()->route('frontend.muhurthambookings.index');
    }

    public function destroy(Muhurthambooking $muhurthambooking)
    {
        abort_if(Gate::denies('muhurthambooking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $muhurthambooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyMuhurthambookingRequest $request)
    {
        $muhurthambookings = Muhurthambooking::find(request('ids'));

        foreach ($muhurthambookings as $muhurthambooking) {
            $muhurthambooking->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
