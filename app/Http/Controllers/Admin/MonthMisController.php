<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMonthMiRequest;
use App\Http\Requests\StoreMonthMiRequest;
use App\Http\Requests\UpdateMonthMiRequest;
use App\Models\MonthMi;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MonthMisController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('month_mi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MonthMi::query()->select(sprintf('%s.*', (new MonthMi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'month_mi_show';
                $editGate      = 'month_mi_edit';
                $deleteGate    = 'month_mi_delete';
                $crudRoutePart = 'month-mis';

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

            $table->editColumn('image', function ($row) {
                return $row->image ? '<a href="' . $row->image->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('rahukalam', function ($row) {
                return $row->rahukalam ? $row->rahukalam : '';
            });
            $table->editColumn('yamagandam', function ($row) {
                return $row->yamagandam ? $row->yamagandam : '';
            });
            $table->editColumn('durmuhurtham', function ($row) {
                return $row->durmuhurtham ? $row->durmuhurtham : '';
            });
            $table->editColumn('thidhi', function ($row) {
                return $row->thidhi ? $row->thidhi : '';
            });
            $table->editColumn('nakshatram', function ($row) {
                return $row->nakshatram ? $row->nakshatram : '';
            });
            $table->editColumn('varjyam', function ($row) {
                return $row->varjyam ? $row->varjyam : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        return view('admin.monthMis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('month_mi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.monthMis.create');
    }

    public function store(StoreMonthMiRequest $request)
    {
        $monthMi = MonthMi::create($request->all());

        if ($request->input('image', false)) {
            $monthMi->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $monthMi->id]);
        }

        return redirect()->route('admin.month-mis.index');
    }

    public function edit(MonthMi $monthMi)
    {
        abort_if(Gate::denies('month_mi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.monthMis.edit', compact('monthMi'));
    }

    public function update(UpdateMonthMiRequest $request, MonthMi $monthMi)
    {
        $monthMi->update($request->all());

        if ($request->input('image', false)) {
            if (! $monthMi->image || $request->input('image') !== $monthMi->image->file_name) {
                if ($monthMi->image) {
                    $monthMi->image->delete();
                }
                $monthMi->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($monthMi->image) {
            $monthMi->image->delete();
        }

        return redirect()->route('admin.month-mis.index');
    }

    public function show(MonthMi $monthMi)
    {
        abort_if(Gate::denies('month_mi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.monthMis.show', compact('monthMi'));
    }

    public function destroy(MonthMi $monthMi)
    {
        abort_if(Gate::denies('month_mi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monthMi->delete();

        return back();
    }

    public function massDestroy(MassDestroyMonthMiRequest $request)
    {
        $monthMis = MonthMi::find(request('ids'));

        foreach ($monthMis as $monthMi) {
            $monthMi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('month_mi_create') && Gate::denies('month_mi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MonthMi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
