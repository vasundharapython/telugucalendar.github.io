<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHoroscopedetailRequest;
use App\Http\Resources\Admin\HoroscopedetailResource;
use App\Models\Horoscopedetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HoroscopedetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('horoscopedetail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HoroscopedetailResource(Horoscopedetail::all());
    }

    public function store(StoreHoroscopedetailRequest $request)
    {
        $horoscopedetail = Horoscopedetail::create($request->all());

        return (new HoroscopedetailResource($horoscopedetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(Horoscopedetail $horoscopedetail)
    {
        abort_if(Gate::denies('horoscopedetail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $horoscopedetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
