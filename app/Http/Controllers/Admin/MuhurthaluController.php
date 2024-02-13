<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMuhurthaluRequest;
use App\Http\Requests\StoreMuhurthaluRequest;
use App\Http\Requests\UpdateMuhurthaluRequest;
use App\Models\Muhurthalu;
use App\Models\Nelalu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class MuhurthaluController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('muhurthalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Muhurthalu::with(['month'])->select(sprintf('%s.*', (new Muhurthalu)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'muhurthalu_show';
                $editGate      = 'muhurthalu_edit';
                $deleteGate    = 'muhurthalu_delete';
                $crudRoutePart = 'muhurthalus';

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
            $table->addColumn('month_month', function ($row) {
                return $row->month ? $row->month->month : '';
            });

            $table->editColumn('muhurtham', function ($row) {
                return $row->muhurtham ? $row->muhurtham : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'month']);

            return $table->make(true);
        }

        return view('admin.muhurthalus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('muhurthalu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Nelalu::pluck('month', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.muhurthalus.create', compact('months'));
    }

    public function store(StoreMuhurthaluRequest $request)
    {
        $muhurthalu = Muhurthalu::create($request->all());
        $slug = SlugService::createSlug(Muhurthalu::class, 'slug', $request->muhurtham);
        $muhurthalu->slug = $slug;
        $muhurthalu->save();

        return redirect()->route('admin.muhurthalus.index');
    }

    public function edit(Muhurthalu $muhurthalu)
    {
        abort_if(Gate::denies('muhurthalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Nelalu::pluck('month', 'id')->prepend(trans('global.pleaseSelect'), '');

        $muhurthalu->load('month');

        return view('admin.muhurthalus.edit', compact('months', 'muhurthalu'));
    }

    public function update(UpdateMuhurthaluRequest $request, Muhurthalu $muhurthalu)
    {
        $muhurthalu->update($request->all());

        return redirect()->route('admin.muhurthalus.index');
    }

    public function show(Muhurthalu $muhurthalu)
    {
        abort_if(Gate::denies('muhurthalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $muhurthalu->load('month');

        return view('admin.muhurthalus.show', compact('muhurthalu'));
    }

    public function destroy(Muhurthalu $muhurthalu)
    {
        abort_if(Gate::denies('muhurthalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $muhurthalu->delete();

        return back();
    }

    public function massDestroy(MassDestroyMuhurthaluRequest $request)
    {
        $muhurthalus = Muhurthalu::find(request('ids'));

        foreach ($muhurthalus as $muhurthalu) {
            $muhurthalu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}


