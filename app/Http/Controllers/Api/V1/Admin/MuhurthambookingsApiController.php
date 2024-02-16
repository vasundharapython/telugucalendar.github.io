<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMuhurthambookingRequest;
use App\Http\Resources\Admin\MuhurthambookingResource;
use App\Models\Muhurthambooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MuhurthambookingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('muhurthambooking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MuhurthambookingResource(Muhurthambooking::all());
    }

    public function store(StoreMuhurthambookingRequest $request)
    {
        $muhurthambooking = Muhurthambooking::create($request->all());

        return (new MuhurthambookingResource($muhurthambooking))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(Muhurthambooking $muhurthambooking)
    {
        abort_if(Gate::denies('muhurthambooking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $muhurthambooking->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
