<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnlinepujadetailRequest;
use App\Http\Resources\Admin\OnlinepujadetailResource;
use App\Models\Onlinepujadetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlinepujadetailsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('onlinepujadetail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OnlinepujadetailResource(Onlinepujadetail::all());
    }

    public function store(StoreOnlinepujadetailRequest $request)
    {
        $onlinepujadetail = Onlinepujadetail::create($request->all());

        return (new OnlinepujadetailResource($onlinepujadetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(Onlinepujadetail $onlinepujadetail)
    {
        abort_if(Gate::denies('onlinepujadetail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $onlinepujadetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
