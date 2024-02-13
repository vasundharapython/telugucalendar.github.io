<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBhakthigeetamRequest;
use App\Http\Requests\StoreBhakthigeetamRequest;
use App\Http\Requests\UpdateBhakthigeetamRequest;
use App\Models\Bhakthigeetam;
use App\Models\BhakthiGeethaCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BhakthigeetamController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bhakthigeetam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Bhakthigeetam::with(['category'])->select(sprintf('%s.*', (new Bhakthigeetam)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bhakthigeetam_show';
                $editGate      = 'bhakthigeetam_edit';
                $deleteGate    = 'bhakthigeetam_delete';
                $crudRoutePart = 'bhakthigeetams';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('category_title', function ($row) {
                return $row->category ? $row->category->title : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('image', function ($row) {
                return $row->image ? '<a href="' . $row->image->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'image']);

            return $table->make(true);
        }

        return view('admin.bhakthigeetams.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bhakthigeetam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = BhakthiGeethaCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bhakthigeetams.create', compact('categories'));
    }

    public function store(StoreBhakthigeetamRequest $request)
    {
        $bhakthigeetam = Bhakthigeetam::create($request->all());
        $slug = SlugService::createSlug(Bhakthigeetam::class, 'slug', $request->title);
        $bhakthigeetam->slug = $slug;
        $bhakthigeetam->save();

        if ($request->input('image', false)) {
            $bhakthigeetam->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bhakthigeetam->id]);
        }

        return redirect()->route('admin.bhakthigeetams.index');
    }

    public function edit(Bhakthigeetam $bhakthigeetam)
    {
        abort_if(Gate::denies('bhakthigeetam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = BhakthiGeethaCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bhakthigeetam->load('category');

        return view('admin.bhakthigeetams.edit', compact('bhakthigeetam', 'categories'));
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

        return redirect()->route('admin.bhakthigeetams.index');
    }

    public function show(Bhakthigeetam $bhakthigeetam)
    {
        abort_if(Gate::denies('bhakthigeetam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bhakthigeetam->load('category');

        return view('admin.bhakthigeetams.show', compact('bhakthigeetam'));
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
