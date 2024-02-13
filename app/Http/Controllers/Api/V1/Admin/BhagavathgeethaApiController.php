<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBhagavathgeethaRequest;
use App\Http\Requests\UpdateBhagavathgeethaRequest;
use App\Http\Resources\Admin\BhagavathgeethaResource;
use App\Models\Bhagavathgeetha;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BhagavathgeethaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bhagavathgeetha_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BhagavathgeethaResource(Bhagavathgeetha::all());
    }

    public function store(StoreBhagavathgeethaRequest $request)
    {
        $bhagavathgeetha = Bhagavathgeetha::create($request->all());

        if ($request->input('image', false)) {
            $bhagavathgeetha->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new BhagavathgeethaResource($bhagavathgeetha))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bhagavathgeetha $bhagavathgeetha)
    {
        abort_if(Gate::denies('bhagavathgeetha_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BhagavathgeethaResource($bhagavathgeetha);
    }

    public function update(UpdateBhagavathgeethaRequest $request, Bhagavathgeetha $bhagavathgeetha)
    {
        $bhagavathgeetha->update($request->all());

        if ($request->input('image', false)) {
            if (! $bhagavathgeetha->image || $request->input('image') !== $bhagavathgeetha->image->file_name) {
                if ($bhagavathgeetha->image) {
                    $bhagavathgeetha->image->delete();
                }
                $bhagavathgeetha->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($bhagavathgeetha->image) {
            $bhagavathgeetha->image->delete();
        }

        return (new BhagavathgeethaResource($bhagavathgeetha))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bhagavathgeetha $bhagavathgeetha)
    {
        abort_if(Gate::denies('bhagavathgeetha_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bhagavathgeetha->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
