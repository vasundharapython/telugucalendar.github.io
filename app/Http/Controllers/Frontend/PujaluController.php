<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPujaluRequest;
use App\Http\Requests\StorePujaluRequest;
use App\Http\Requests\UpdatePujaluRequest;
use App\Models\Pujalu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PujaluController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('pujalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pujalus = Pujalu::with(['media'])->get();

        return view('frontend.pujalus.index', compact('pujalus'));
    }

    public function create()
    {
        abort_if(Gate::denies('pujalu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.pujalus.create');
    }

    public function store(StorePujaluRequest $request)
    {
        $pujalu = Pujalu::create($request->all());

        if ($request->input('image', false)) {
            $pujalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pujalu->id]);
        }

        return redirect()->route('frontend.pujalus.index');
    }

    public function edit(Pujalu $pujalu)
    {
        abort_if(Gate::denies('pujalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.pujalus.edit', compact('pujalu'));
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

        return redirect()->route('frontend.pujalus.index');
    }

    public function show(Pujalu $pujalu)
    {
        abort_if(Gate::denies('pujalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.pujalus.show', compact('pujalu'));
    }

    public function destroy(Pujalu $pujalu)
    {
        abort_if(Gate::denies('pujalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pujalu->delete();

        return back();
    }

    public function massDestroy(MassDestroyPujaluRequest $request)
    {
        $pujalus = Pujalu::find(request('ids'));

        foreach ($pujalus as $pujalu) {
            $pujalu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pujalu_create') && Gate::denies('pujalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pujalu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}