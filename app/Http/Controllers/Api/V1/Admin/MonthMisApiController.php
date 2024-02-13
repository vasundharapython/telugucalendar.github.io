<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMonthMiRequest;
use App\Http\Requests\UpdateMonthMiRequest;
use App\Http\Resources\Admin\MonthMiResource;
use App\Models\MonthMi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonthMisApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('month_mi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MonthMiResource(MonthMi::all());
    }

    public function store(StoreMonthMiRequest $request)
    {
        $monthMi = MonthMi::create($request->all());

        if ($request->input('image', false)) {
            $monthMi->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new MonthMiResource($monthMi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MonthMi $monthMi)
    {
        abort_if(Gate::denies('month_mi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MonthMiResource($monthMi);
    }

    public function update(UpdateMonthMiRequest $request, MonthMi $monthMi)
    {
        $monthMi->update($request->all());

        if ($request->input('image', false)) {
            if (! $monthMi->image || $request->input('image') !== $monthMi->image->file_name) {
                if ($monthMi->image) {
                    $monthMi->image->delete();
                }
                $monthMi->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($monthMi->image) {
            $monthMi->image->delete();
        }

        return (new MonthMiResource($monthMi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MonthMi $monthMi)
    {
        abort_if(Gate::denies('month_mi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monthMi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
