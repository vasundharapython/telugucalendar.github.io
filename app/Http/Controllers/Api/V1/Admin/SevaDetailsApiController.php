<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSevaDetailRequest;
use App\Http\Resources\Admin\SevaDetailResource;
use App\Models\SevaDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SevaDetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('seva_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SevaDetailResource(SevaDetail::all());
    }

    public function store(StoreSevaDetailRequest $request)
    {
        $sevaDetail = SevaDetail::create($request->all());

        return (new SevaDetailResource($sevaDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(SevaDetail $sevaDetail)
    {
        abort_if(Gate::denies('seva_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sevaDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
