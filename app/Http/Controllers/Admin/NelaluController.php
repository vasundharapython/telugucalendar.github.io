<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyNelaluRequest;
use App\Http\Requests\StoreNelaluRequest;
use App\Http\Requests\UpdateNelaluRequest;
use App\Models\Nelalu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class NelaluController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('nelalu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Nelalu::query()->select(sprintf('%s.*', (new Nelalu)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'nelalu_show';
                $editGate      = 'nelalu_edit';
                $deleteGate    = 'nelalu_delete';
                $crudRoutePart = 'nelalus';

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
            $table->editColumn('month', function ($row) {
                return $row->month ? $row->month : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.nelalus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('nelalu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nelalus.create');
    }

    public function store(StoreNelaluRequest $request)
    {
        $nelalu = Nelalu::create($request->all());
        $slug = SlugService::createSlug(Nelalu::class, 'slug', $request->month);
        $nelalu->slug = $slug;
        $nelalu->save();

        return redirect()->route('admin.nelalus.index');
    }

    public function edit(Nelalu $nelalu)
    {
        abort_if(Gate::denies('nelalu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nelalus.edit', compact('nelalu'));
    }

    public function update(UpdateNelaluRequest $request, Nelalu $nelalu)
    {
        $nelalu->update($request->all());

        return redirect()->route('admin.nelalus.index');
    }

    public function show(Nelalu $nelalu)
    {
        abort_if(Gate::denies('nelalu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nelalu->load('monthMuhurthalus', 'monthMonths');

        return view('admin.nelalus.show', compact('nelalu'));
    }

    public function destroy(Nelalu $nelalu)
    {
        abort_if(Gate::denies('nelalu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nelalu->delete();

        return back();
    }

    public function massDestroy(MassDestroyNelaluRequest $request)
    {
        $nelalus = Nelalu::find(request('ids'));

        foreach ($nelalus as $nelalu) {
            $nelalu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
