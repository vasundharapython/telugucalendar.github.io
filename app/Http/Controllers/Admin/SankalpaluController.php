<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySankalpaluRequest;
use App\Http\Requests\StoreSankalpaluRequest;
use App\Http\Requests\UpdateSankalpaluRequest;
use App\Models\Sankalpalu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SankalpaluController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sankalpalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sankalpalu::query()->select(sprintf('%s.*', (new Sankalpalu)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sankalpalu_show';
                $editGate      = 'sankalpalu_edit';
                $deleteGate    = 'sankalpalu_delete';
                $crudRoutePart = 'sankalpalus';

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

        return view('admin.sankalpalus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sankalpalu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sankalpalus.create');
    }

    public function store(StoreSankalpaluRequest $request)
    {
        $sankalpalu = Sankalpalu::create($request->all());
        $slug = SlugService::createSlug(Sankalpalu::class, 'slug', $request->title);
        $sankalpalu->slug = $slug;
        $sankalpalu->save();

        if ($request->input('image', false)) {
            $sankalpalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sankalpalu->id]);
        }

        return redirect()->route('admin.sankalpalus.index');
    }

    public function edit(Sankalpalu $sankalpalu)
    {
        abort_if(Gate::denies('sankalpalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sankalpalus.edit', compact('sankalpalu'));
    }

    public function update(UpdateSankalpaluRequest $request, Sankalpalu $sankalpalu)
    {
        $sankalpalu->update($request->all());

        if ($request->input('image', false)) {
            if (! $sankalpalu->image || $request->input('image') !== $sankalpalu->image->file_name) {
                if ($sankalpalu->image) {
                    $sankalpalu->image->delete();
                }
                $sankalpalu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($sankalpalu->image) {
            $sankalpalu->image->delete();
        }

        return redirect()->route('admin.sankalpalus.index');
    }

    public function show(Sankalpalu $sankalpalu)
    {
        abort_if(Gate::denies('sankalpalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sankalpalus.show', compact('sankalpalu'));
    }

    public function destroy(Sankalpalu $sankalpalu)
    {
        abort_if(Gate::denies('sankalpalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sankalpalu->delete();

        return back();
    }

    public function massDestroy(MassDestroySankalpaluRequest $request)
    {
        $sankalpalus = Sankalpalu::find(request('ids'));

        foreach ($sankalpalus as $sankalpalu) {
            $sankalpalu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sankalpalu_create') && Gate::denies('sankalpalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Sankalpalu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
