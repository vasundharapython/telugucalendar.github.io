<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGodanamDetailRequest;
use App\Http\Resources\Admin\GodanamDetailResource;
use App\Models\GodanamDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GodanamDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('godanam_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GodanamDetailResource(GodanamDetail::all());
    }

    public function store(StoreGodanamDetailRequest $request)
    {
        $godanamDetail = GodanamDetail::create($request->all());

        return (new GodanamDetailResource($godanamDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(GodanamDetail $godanamDetail)
    {
        abort_if(Gate::denies('godanam_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $godanamDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
