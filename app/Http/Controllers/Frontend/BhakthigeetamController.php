<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBhakthigeetamRequest;
use App\Http\Requests\StoreBhakthigeetamRequest;
use App\Http\Requests\UpdateBhakthigeetamRequest;
use App\Models\Bhakthigeetam;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BhakthigeetamController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bhakthigeetam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bhakthigeetams = Bhakthigeetam::with(['media'])->get();

        return view('frontend.bhakthigeetams.index', compact('bhakthigeetams'));
    }

    public function create()
    {
        abort_if(Gate::denies('bhakthigeetam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.bhakthigeetams.create');
    }

    public function store(StoreBhakthigeetamRequest $request)
    {
        $bhakthigeetam = Bhakthigeetam::create($request->all());

        if ($request->input('image', false)) {
            $bhakthigeetam->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bhakthigeetam->id]);
        }

        return redirect()->route('frontend.bhakthigeetams.index');
    }

    public function edit(Bhakthigeetam $bhakthigeetam)
    {
        abort_if(Gate::denies('bhakthigeetam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.bhakthigeetams.edit', compact('bhakthigeetam'));
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

        return redirect()->route('frontend.bhakthigeetams.index');
    }

    public function show(Bhakthigeetam $bhakthigeetam)
    {
        abort_if(Gate::denies('bhakthigeetam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.bhakthigeetams.show', compact('bhakthigeetam'));
    }

    public function destroy(Bhakthigeetam $bhakthigeetam)
    {
        abort_if(Gate::denies('bhakthigeetam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bhakthigeetam->delete();

        return back();
    }

    public function massDestroy(MassDestroyBhakthigeetamRequest $request)
    {
        $bhakthigeetams = Bhakthigeetam::find(request('ids'));

        foreach ($bhakthigeetams as $bhakthigeetam) {
            $bhakthigeetam->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bhakthigeetam_create') && Gate::denies('bhakthigeetam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Bhakthigeetam();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
