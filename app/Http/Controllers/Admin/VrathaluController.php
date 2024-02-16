<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class VrathaluController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vrathalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Vrathalu::query()->select(sprintf('%s.*', (new Vrathalu)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vrathalu_show';
                $editGate      = 'vrathalu_edit';
                $deleteGate    = 'vrathalu_delete';
                $crudRoutePart = 'vrathalus';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('image', function ($row) {
                return $row->image ? '<a href="' . $row->image->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        return view('admin.vrathalus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vrathalu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vrathalus.create');
    }

    public function store(StoreVrathaluRequest $request)
    {
        $vrathalu = Vrathalu::create($request->all());
        $slug = SlugService::createSlug(Vrathalu::class, 'slug', $request->title);
        $vrathalu->slug = $slug;
        $vrathalu->save();

        if ($request->input('image', false)) {
            $vrathalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $vrathalu->id]);
        }

        return redirect()->route('admin.vrathalus.index');
    }

    public function edit(Vrathalu $vrathalu)
    {
        abort_if(Gate::denies('vrathalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vrathalus.edit', compact('vrathalu'));
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

        return redirect()->route('admin.vrathalus.index');
    }

    public function show(Vrathalu $vrathalu)
    {
        abort_if(Gate::denies('vrathalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vrathalus.show', compact('vrathalu'));
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
