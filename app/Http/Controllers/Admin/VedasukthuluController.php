<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVedasukthuluRequest;
use App\Http\Requests\StoreVedasukthuluRequest;
use App\Http\Requests\UpdateVedasukthuluRequest;
use App\Models\Vedasukthulu;
use App\Models\VedasukthuluSubCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class VedasukthuluController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vedasukthulu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Vedasukthulu::with(['subcategory'])->select(sprintf('%s.*', (new Vedasukthulu)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vedasukthulu_show';
                $editGate      = 'vedasukthulu_edit';
                $deleteGate    = 'vedasukthulu_delete';
                $crudRoutePart = 'vedasukthulus';

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
            $table->addColumn('subcategory_title', function ($row) {
                return $row->subcategory ? $row->subcategory->title : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('image', function ($row) {
                return $row->image ? '<a href="' . $row->image->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'subcategory', 'image']);

            return $table->make(true);
        }

        return view('admin.vedasukthulus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vedasukthulu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategories = VedasukthuluSubCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vedasukthulus.create', compact('subcategories'));
    }

    public function store(StoreVedasukthuluRequest $request)
    {
        $vedasukthulu = Vedasukthulu::create($request->all());
        $slug = SlugService::createSlug(Vedasukthulu::class, 'slug', $request->title);
        $vedasukthulu->slug = $slug;
        $vedasukthulu->save();

        if ($request->input('image', false)) {
            $vedasukthulu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $vedasukthulu->id]);
        }

        return redirect()->route('admin.vedasukthulus.index');
    }

    public function edit(Vedasukthulu $vedasukthulu)
    {
        abort_if(Gate::denies('vedasukthulu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategories = VedasukthuluSubCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vedasukthulu->load('subcategory');

        return view('admin.vedasukthulus.edit', compact('subcategories', 'vedasukthulu'));
    }

    public function update(UpdateVedasukthuluRequest $request, Vedasukthulu $vedasukthulu)
    {
        $vedasukthulu->update($request->all());

        if ($request->input('image', false)) {
            if (! $vedasukthulu->image || $request->input('image') !== $vedasukthulu->image->file_name) {
                if ($vedasukthulu->image) {
                    $vedasukthulu->image->delete();
                }
                $vedasukthulu->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($vedasukthulu->image) {
            $vedasukthulu->image->delete();
        }

        return redirect()->route('admin.vedasukthulus.index');
    }

    public function show(Vedasukthulu $vedasukthulu)
    {
        abort_if(Gate::denies('vedasukthulu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasukthulu->load('subcategory');

        return view('admin.vedasukthulus.show', compact('vedasukthulu'));
    }

    public function destroy(Vedasukthulu $vedasukthulu)
    {
        abort_if(Gate::denies('vedasukthulu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasukthulu->delete();

        return back();
    }

    public function massDestroy(MassDestroyVedasukthuluRequest $request)
    {
        $vedasukthulus = Vedasukthulu::find(request('ids'));

        foreach ($vedasukthulus as $vedasukthulu) {
            $vedasukthulu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('vedasukthulu_create') && Gate::denies('vedasukthulu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Vedasukthulu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
