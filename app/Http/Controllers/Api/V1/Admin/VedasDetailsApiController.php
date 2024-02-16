<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVedasDetailRequest;
use App\Http\Resources\Admin\VedasDetailResource;
use App\Models\VedasDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VedasDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vedas_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VedasDetailResource(VedasDetail::all());
    }

    public function store(StoreVedasDetailRequest $request)
    {
        $vedasDetail = VedasDetail::create($request->all());

        return (new VedasDetailResource($vedasDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(VedasDetail $vedasDetail)
    {
        abort_if(Gate::denies('vedas_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
