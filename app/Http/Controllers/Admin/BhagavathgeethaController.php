<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBhagavathgeethaRequest;
use App\Http\Requests\StoreBhagavathgeethaRequest;
use App\Http\Requests\UpdateBhagavathgeethaRequest;
use App\Models\Bhagavathgeetha;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BhagavathgeethaController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bhagavathgeetha_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Bhagavathgeetha::query()->select(sprintf('%s.*', (new Bhagavathgeetha)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bhagavathgeetha_show';
                $editGate      = 'bhagavathgeetha_edit';
                $deleteGate    = 'bhagavathgeetha_delete';
                $crudRoutePart = 'bhagavathgeethas';

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

        return view('admin.bhagavathgeethas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bhagavathgeetha_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bhagavathgeethas.create');
    }

    public function store(StoreBhagavathgeethaRequest $request)
    {
        $bhagavathgeetha = Bhagavathgeetha::create($request->all());
        $slug = SlugService::createSlug(Bhagavathgeetha::class, 'slug', $request->title);
        $bhagavathgeetha->slug = $slug;
        $bhagavathgeetha->save();

        if ($request->input('image', false)) {
            $bhagavathgeetha->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bhagavathgeetha->id]);
        }

        return redirect()->route('admin.bhagavathgeethas.index');
    }

    public function edit(Bhagavathgeetha $bhagavathgeetha)
    {
        abort_if(Gate::denies('bhagavathgeetha_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bhagavathgeethas.edit', compact('bhagavathgeetha'));
    }

    public function update(UpdateBhagavathgeethaRequest $request, Bhagavathgeetha $bhagavathgeetha)
    {
        $bhagavathgeetha->update($request->all());

        if ($request->input('image', false)) {
            if (! $bhagavathgeetha->image || $request->input('image') !== $bhagavathgeetha->image->file_name) {
                if ($bhagavathgeetha->image) {
                    $bhagavathgeetha->image->delete();
                }
                $bhagavathgeetha->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($bhagavathgeetha->image) {
            $bhagavathgeetha->image->delete();
        }

        return redirect()->route('admin.bhagavathgeethas.index');
    }

    public function show(Bhagavathgeetha $bhagavathgeetha)
    {
        abort_if(Gate::denies('bhagavathgeetha_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bhagavathgeethas.show', compact('bhagavathgeetha'));
    }

    public function destroy(Bhagavathgeetha $bhagavathgeetha)
    {
        abort_if(Gate::denies('bhagavathgeetha_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bhagavathgeetha->delete();

        return back();
    }

    public function massDestroy(MassDestroyBhagavathgeethaRequest $request)
    {
        $bhagavathgeethas = Bhagavathgeetha::find(request('ids'));

        foreach ($bhagavathgeethas as $bhagavathgeetha) {
            $bhagavathgeetha->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bhagavathgeetha_create') && Gate::denies('bhagavathgeetha_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Bhagavathgeetha();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
