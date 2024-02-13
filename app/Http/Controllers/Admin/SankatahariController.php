<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySankatahariRequest;
use App\Http\Requests\StoreSankatahariRequest;
use App\Http\Requests\UpdateSankatahariRequest;
use App\Models\Sankatahari;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SankatahariController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sankatahari_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Sankatahari::query()->select(sprintf('%s.*', (new Sankatahari)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sankatahari_show';
                $editGate      = 'sankatahari_edit';
                $deleteGate    = 'sankatahari_delete';
                $crudRoutePart = 'sankataharis';

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

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.sankataharis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sankatahari_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sankataharis.create');
    }

    public function store(StoreSankatahariRequest $request)
    {
        $sankatahari = Sankatahari::create($request->all());

        return redirect()->route('admin.sankataharis.index');
    }

    public function edit(Sankatahari $sankatahari)
    {
        abort_if(Gate::denies('sankatahari_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sankataharis.edit', compact('sankatahari'));
    }

    public function update(UpdateSankatahariRequest $request, Sankatahari $sankatahari)
    {
        $sankatahari->update($request->all());

        return redirect()->route('admin.sankataharis.index');
    }

    public function show(Sankatahari $sankatahari)
    {
        abort_if(Gate::denies('sankatahari_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sankataharis.show', compact('sankatahari'));
    }

    public function destroy(Sankatahari $sankatahari)
    {
        abort_if(Gate::denies('sankatahari_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sankatahari->delete();

        return back();
    }

    public function massDestroy(MassDestroySankatahariRequest $request)
    {
        $sankataharis = Sankatahari::find(request('ids'));

        foreach ($sankataharis as $sankatahari) {
            $sankatahari->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
