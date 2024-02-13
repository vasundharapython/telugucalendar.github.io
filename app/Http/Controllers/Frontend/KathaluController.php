<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyKathaluRequest;
use App\Http\Requests\StoreKathaluRequest;
use App\Http\Requests\UpdateKathaluRequest;
use App\Models\Kathalu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class KathaluController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('kathalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kathalus = Kathalu::with(['media'])->get();

        return view('frontend.kathalus.index', compact('kathalus'));
    }

    public function create()
    {
        abort_if(Gate::denies('kathalu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.kathalus.create');
    }

    public function store(StoreKathaluRequest $request)
    {
        $kathalu = Kathalu::create($request->all());

        if ($request->input('image', false)) {
            $kathalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $kathalu->id]);
        }

        return redirect()->route('frontend.kathalus.index');
    }

    public function edit(Kathalu $kathalu)
    {
        abort_if(Gate::denies('kathalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.kathalus.edit', compact('kathalu'));
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

        return redirect()->route('frontend.kathalus.index');
    }

    public function show(Kathalu $kathalu)
    {
        abort_if(Gate::denies('kathalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.kathalus.show', compact('kathalu'));
    }

    public function destroy(Kathalu $kathalu)
    {
        abort_if(Gate::denies('kathalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kathalu->delete();

        return back();
    }

    public function massDestroy(MassDestroyKathaluRequest $request)
    {
        $kathalus = Kathalu::find(request('ids'));

        foreach ($kathalus as $kathalu) {
            $kathalu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('kathalu_create') && Gate::denies('kathalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Kathalu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
