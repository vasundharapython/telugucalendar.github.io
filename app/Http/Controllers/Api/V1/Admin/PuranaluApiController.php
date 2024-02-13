<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePuranaluRequest;
use App\Http\Requests\UpdatePuranaluRequest;
use App\Http\Resources\Admin\PuranaluResource;
use App\Models\Puranalu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PuranaluApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('puranalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PuranaluResource(Puranalu::all());
    }

    public function store(StorePuranaluRequest $request)
    {
        $puranalu = Puranalu::create($request->all());

        if ($request->input('image', false)) {
            $puranalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new PuranaluResource($puranalu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Puranalu $puranalu)
    {
        abort_if(Gate::denies('puranalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PuranaluResource($puranalu);
    }

    public function update(UpdatePuranaluRequest $request, Puranalu $puranalu)
    {
        $puranalu->update($request->all());

        if ($request->input('image', false)) {
            if (! $puranalu->image || $request->input('image') !== $puranalu->image->file_name) {
                if ($puranalu->image) {
                    $puranalu->image->delete();
                }
                $puranalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($puranalu->image) {
            $puranalu->image->delete();
        }

        return (new PuranaluResource($puranalu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Puranalu $puranalu)
    {
        abort_if(Gate::denies('puranalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puranalu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
