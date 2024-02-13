<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySthothraluCopyRequest;
use App\Http\Requests\StoreSthothraluCopyRequest;
use App\Http\Requests\UpdateSthothraluCopyRequest;
use App\Models\SsubCategory;
use App\Models\SthothraluCopy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class SthothraluCopyController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sthothralu_copy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SthothraluCopy::with(['ssubcategory'])->select(sprintf('%s.*', (new SthothraluCopy)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sthothralu_copy_show';
                $editGate      = 'sthothralu_copy_edit';
                $deleteGate    = 'sthothralu_copy_delete';
                $crudRoutePart = 'sthothralu-copies';

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
            $table->addColumn('ssubcategory_title', function ($row) {
                return $row->ssubcategory ? $row->ssubcategory->title : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('image', function ($row) {
                return $row->image ? '<a href="' . $row->image->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'ssubcategory', 'image']);

            return $table->make(true);
        }

        return view('admin.sthothraluCopies.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sthothralu_copy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ssubcategories = SsubCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sthothraluCopies.create', compact('ssubcategories'));
    }

    public function store(StoreSthothraluCopyRequest $request)
    {
        $sthothraluCopy = SthothraluCopy::create($request->all());
        $slug = SlugService::createSlug(SthothraluCopy::class, 'slug', $request->title);
        $sthothraluCopy->slug = $slug;
        $sthothraluCopy->save();

        if ($request->input('image', false)) {
            $sthothraluCopy->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sthothraluCopy->id]);
        }

        return redirect()->route('admin.sthothralu-copies.index');
    }

    public function edit(SthothraluCopy $sthothraluCopy)
    {
        abort_if(Gate::denies('sthothralu_copy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ssubcategories = SsubCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sthothraluCopy->load('ssubcategory');

        return view('admin.sthothraluCopies.edit', compact('ssubcategories', 'sthothraluCopy'));
    }

    public function update(UpdateSthothraluCopyRequest $request, SthothraluCopy $sthothraluCopy)
    {
        $sthothraluCopy->update($request->all());

        if ($request->input('image', false)) {
            if (! $sthothraluCopy->image || $request->input('image') !== $sthothraluCopy->image->file_name) {
                if ($sthothraluCopy->image) {
                    $sthothraluCopy->image->delete();
                }
                $sthothraluCopy->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($sthothraluCopy->image) {
            $sthothraluCopy->image->delete();
        }

        return redirect()->route('admin.sthothralu-copies.index');
    }

    public function show(SthothraluCopy $sthothraluCopy)
    {
        abort_if(Gate::denies('sthothralu_copy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sthothraluCopy->load('ssubcategory');

        return view('admin.sthothraluCopies.show', compact('sthothraluCopy'));
    }

    public function destroy(SthothraluCopy $sthothraluCopy)
    {
        abort_if(Gate::denies('sthothralu_copy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sthothraluCopy->delete();

        return back();
    }

    public function massDestroy(MassDestroySthothraluCopyRequest $request)
    {
        $sthothraluCopies = SthothraluCopy::find(request('ids'));

        foreach ($sthothraluCopies as $sthothraluCopy) {
            $sthothraluCopy->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sthothralu_copy_create') && Gate::denies('sthothralu_copy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SthothraluCopy();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
