<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreKathaluRequest;
use App\Http\Requests\UpdateKathaluRequest;
use App\Http\Resources\Admin\KathaluResource;
use App\Models\Kathalu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KathaluApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('kathalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KathaluResource(Kathalu::all());
    }

    public function store(StoreKathaluRequest $request)
    {
        $kathalu = Kathalu::create($request->all());

        if ($request->input('image', false)) {
            $kathalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new KathaluResource($kathalu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Kathalu $kathalu)
    {
        abort_if(Gate::denies('kathalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KathaluResource($kathalu);
    }

    public function update(UpdateKathaluRequest $request, Kathalu $kathalu)
    {
        $kathalu->update($request->all());

        if ($request->input('image', false)) {
            if (! $kathalu->image || $request->input('image') !== $kathalu->image->file_name) {
                if ($kathalu->image) {
                    $kathalu->image->delete();
                }
                $kathalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($kathalu->image) {
            $kathalu->image->delete();
        }

        return (new KathaluResource($kathalu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Kathalu $kathalu)
    {
        abort_if(Gate::denies('kathalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kathalu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
