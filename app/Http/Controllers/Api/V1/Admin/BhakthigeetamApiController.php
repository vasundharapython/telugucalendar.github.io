<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBhakthigeetamRequest;
use App\Http\Requests\UpdateBhakthigeetamRequest;
use App\Http\Resources\Admin\BhakthigeetamResource;
use App\Models\Bhakthigeetam;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BhakthigeetamApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bhakthigeetam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BhakthigeetamResource(Bhakthigeetam::all());
    }

    public function store(StoreBhakthigeetamRequest $request)
    {
        $bhakthigeetam = Bhakthigeetam::create($request->all());

        if ($request->input('image', false)) {
            $bhakthigeetam->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new BhakthigeetamResource($bhakthigeetam))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bhakthigeetam $bhakthigeetam)
    {
        abort_if(Gate::denies('bhakthigeetam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BhakthigeetamResource($bhakthigeetam);
    }

    public function update(UpdateBhakthigeetamRequest $request, Bhakthigeetam $bhakthigeetam)
    {
        $bhakthigeetam->update($request->all());

        if ($request->input('image', false)) {
            if (! $bhakthigeetam->image || $request->input('image') !== $bhakthigeetam->image->file_name) {
                if ($bhakthigeetam->image) {
                    $bhakthigeetam->image->delete();
                }
                $bhakthigeetam->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($bhakthigeetam->image) {
            $bhakthigeetam->image->delete();
        }

        return (new BhakthigeetamResource($bhakthigeetam))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bhakthigeetam $bhakthigeetam)
    {
        abort_if(Gate::denies('bhakthigeetam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bhakthigeetam->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
