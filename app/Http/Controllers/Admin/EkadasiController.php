<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEkadasiRequest;
use App\Http\Requests\StoreEkadasiRequest;
use App\Http\Requests\UpdateEkadasiRequest;
use App\Models\Ekadasi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EkadasiController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ekadasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Ekadasi::query()->select(sprintf('%s.*', (new Ekadasi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'ekadasi_show';
                $editGate      = 'ekadasi_edit';
                $deleteGate    = 'ekadasi_delete';
                $crudRoutePart = 'ekadasis';

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

        return view('admin.ekadasis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ekadasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ekadasis.create');
    }

    public function store(StoreEkadasiRequest $request)
    {
        $ekadasi = Ekadasi::create($request->all());

        return redirect()->route('admin.ekadasis.index');
    }

    public function edit(Ekadasi $ekadasi)
    {
        abort_if(Gate::denies('ekadasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ekadasis.edit', compact('ekadasi'));
    }

    public function update(UpdateEkadasiRequest $request, Ekadasi $ekadasi)
    {
        $ekadasi->update($request->all());

        return redirect()->route('admin.ekadasis.index');
    }

    public function show(Ekadasi $ekadasi)
    {
        abort_if(Gate::denies('ekadasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ekadasis.show', compact('ekadasi'));
    }

    public function destroy(Ekadasi $ekadasi)
    {
        abort_if(Gate::denies('ekadasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ekadasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyEkadasiRequest $request)
    {
        $ekadasis = Ekadasi::find(request('ids'));

        foreach ($ekadasis as $ekadasi) {
            $ekadasi->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
