<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySthotraluRequest;
use App\Http\Requests\StoreSthotraluRequest;
use App\Http\Requests\UpdateSthotraluRequest;
use App\Models\SthothraluSubCategory;
use App\Models\Sthotralu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SthotraluController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sthotralu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sthotralu::with(['category'])->select(sprintf('%s.*', (new Sthotralu)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sthotralu_show';
                $editGate      = 'sthotralu_edit';
                $deleteGate    = 'sthotralu_delete';
                $crudRoutePart = 'sthotralus';

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

        return view('admin.sthotralus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sthotralu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = SthothraluSubCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sthotralus.create', compact('categories'));
    }

    public function store(StoreSthotraluRequest $request)
    {
        $sthotralu = Sthotralu::create($request->all());
        $slug = SlugService::createSlug(Sthotralu::class, 'slug', $request->title);
        $sthotralu->slug = $slug;
        $sthotralu->save();

        if ($request->input('image', false)) {
            $sthotralu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sthotralu->id]);
        }

        return redirect()->route('admin.sthotralus.index');
    }

    public function edit(Sthotralu $sthotralu)
    {
        abort_if(Gate::denies('sthotralu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = SthothraluSubCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sthotralu->load('category');

        return view('admin.sthotralus.edit', compact('categories', 'sthotralu'));
    }

    public function update(UpdateSthotraluRequest $request, Sthotralu $sthotralu)
    {
        $sthotralu->update($request->all());

        if ($request->input('image', false)) {
            if (! $sthotralu->image || $request->input('image') !== $sthotralu->image->file_name) {
                if ($sthotralu->image) {
                    $sthotralu->image->delete();
                }
                $sthotralu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($sthotralu->image) {
            $sthotralu->image->delete();
        }

        return redirect()->route('admin.sthotralus.index');
    }

    public function show(Sthotralu $sthotralu)
    {
        abort_if(Gate::denies('sthotralu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sthotralu->load('category');

        return view('admin.sthotralus.show', compact('sthotralu'));
    }

    public function destroy(Sthotralu $sthotralu)
    {
        abort_if(Gate::denies('sthotralu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sthotralu->delete();

        return back();
    }

    public function massDestroy(MassDestroySthotraluRequest $request)
    {
        $sthotralus = Sthotralu::find(request('ids'));

        foreach ($sthotralus as $sthotralu) {
            $sthotralu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sthotralu_create') && Gate::denies('sthotralu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Sthotralu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}


