<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreVrathaluRequest;
use App\Http\Requests\UpdateVrathaluRequest;
use App\Http\Resources\Admin\VrathaluResource;
use App\Models\Vrathalu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VrathaluApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('vrathalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VrathaluResource(Vrathalu::all());
    }

    public function store(StoreVrathaluRequest $request)
    {
        $vrathalu = Vrathalu::create($request->all());

        if ($request->input('image', false)) {
            $vrathalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new VrathaluResource($vrathalu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Vrathalu $vrathalu)
    {
        abort_if(Gate::denies('vrathalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VrathaluResource($vrathalu);
    }

    public function update(UpdateVrathaluRequest $request, Vrathalu $vrathalu)
    {
        $vrathalu->update($request->all());

        if ($request->input('image', false)) {
            if (! $vrathalu->image || $request->input('image') !== $vrathalu->image->file_name) {
                if ($vrathalu->image) {
                    $vrathalu->image->delete();
                }
                $vrathalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($vrathalu->image) {
            $vrathalu->image->delete();
        }

        return (new VrathaluResource($vrathalu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Vrathalu $vrathalu)
    {
        abort_if(Gate::denies('vrathalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vrathalu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
