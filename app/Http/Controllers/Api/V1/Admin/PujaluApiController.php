<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePujaluRequest;
use App\Http\Requests\UpdatePujaluRequest;
use App\Http\Resources\Admin\PujaluResource;
use App\Models\Pujalu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PujaluApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pujalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PujaluResource(Pujalu::all());
    }

    public function store(StorePujaluRequest $request)
    {
        $pujalu = Pujalu::create($request->all());

        if ($request->input('image', false)) {
            $pujalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new PujaluResource($pujalu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pujalu $pujalu)
    {
        abort_if(Gate::denies('pujalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PujaluResource($pujalu);
    }

    public function update(UpdatePujaluRequest $request, Pujalu $pujalu)
    {
        $pujalu->update($request->all());

        if ($request->input('image', false)) {
            if (! $pujalu->image || $request->input('image') !== $pujalu->image->file_name) {
                if ($pujalu->image) {
                    $pujalu->image->delete();
                }
                $pujalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($pujalu->image) {
            $pujalu->image->delete();
        }

        return (new PujaluResource($pujalu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pujalu $pujalu)
    {
        abort_if(Gate::denies('pujalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pujalu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
