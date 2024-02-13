<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVrathaluRequest;
use App\Http\Requests\StoreVrathaluRequest;
use App\Http\Requests\UpdateVrathaluRequest;
use App\Models\Vrathalu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VrathaluController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('vrathalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vrathalus = Vrathalu::with(['media'])->get();

        return view('frontend.vrathalus.index', compact('vrathalus'));
    }

    public function create()
    {
        abort_if(Gate::denies('vrathalu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vrathalus.create');
    }

    public function store(StoreVrathaluRequest $request)
    {
        $vrathalu = Vrathalu::create($request->all());

        if ($request->input('image', false)) {
            $vrathalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $vrathalu->id]);
        }

        return redirect()->route('frontend.vrathalus.index');
    }

    public function edit(Vrathalu $vrathalu)
    {
        abort_if(Gate::denies('vrathalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vrathalus.edit', compact('vrathalu'));
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

        return redirect()->route('frontend.vrathalus.index');
    }

    public function show(Vrathalu $vrathalu)
    {
        abort_if(Gate::denies('vrathalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vrathalus.show', compact('vrathalu'));
    }

    public function destroy(Vrathalu $vrathalu)
    {
        abort_if(Gate::denies('vrathalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vrathalu->delete();

        return back();
    }

    public function massDestroy(MassDestroyVrathaluRequest $request)
    {
        $vrathalus = Vrathalu::find(request('ids'));

        foreach ($vrathalus as $vrathalu) {
            $vrathalu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('vrathalu_create') && Gate::denies('vrathalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Vrathalu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
