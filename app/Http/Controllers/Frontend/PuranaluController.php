<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPuranaluRequest;
use App\Http\Requests\StorePuranaluRequest;
use App\Http\Requests\UpdatePuranaluRequest;
use App\Models\Puranalu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PuranaluController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('puranalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puranalus = Puranalu::with(['media'])->get();

        return view('frontend.puranalus.index', compact('puranalus'));
    }

    public function create()
    {
        abort_if(Gate::denies('puranalu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.puranalus.create');
    }

    public function store(StorePuranaluRequest $request)
    {
        $puranalu = Puranalu::create($request->all());

        if ($request->input('image', false)) {
            $puranalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $puranalu->id]);
        }

        return redirect()->route('frontend.puranalus.index');
    }

    public function edit(Puranalu $puranalu)
    {
        abort_if(Gate::denies('puranalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.puranalus.edit', compact('puranalu'));
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

        return redirect()->route('frontend.puranalus.index');
    }

    public function show(Puranalu $puranalu)
    {
        abort_if(Gate::denies('puranalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.puranalus.show', compact('puranalu'));
    }

    public function destroy(Puranalu $puranalu)
    {
        abort_if(Gate::denies('puranalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $puranalu->delete();

        return back();
    }

    public function massDestroy(MassDestroyPuranaluRequest $request)
    {
        $puranalus = Puranalu::find(request('ids'));

        foreach ($puranalus as $puranalu) {
            $puranalu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('puranalu_create') && Gate::denies('puranalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Puranalu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
