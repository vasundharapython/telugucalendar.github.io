<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAnnadanamRequest;
use App\Http\Requests\StoreAnnadanamRequest;
use App\Http\Requests\UpdateAnnadanamRequest;
use App\Models\Annadanam;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AnnadanamController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('annadanam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Annadanam::query()->select(sprintf('%s.*', (new Annadanam)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'annadanam_show';
                $editGate      = 'annadanam_edit';
                $deleteGate    = 'annadanam_delete';
                $crudRoutePart = 'annadanams';

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
            $table->editColumn('occasion', function ($row) {
                return $row->occasion ? $row->occasion : '';
            });
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->editColumn('gotram', function ($row) {
                return $row->gotram ? $row->gotram : '';
            });
            $table->editColumn('star', function ($row) {
                return $row->star ? $row->star : '';
            });
            $table->editColumn('residence', function ($row) {
                return $row->residence ? $row->residence : '';
            });
            $table->editColumn('contact_details', function ($row) {
                return $row->contact_details ? $row->contact_details : '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.annadanams.index');
    }

    public function create()
    {
        abort_if(Gate::denies('annadanam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.annadanams.create');
    }

    public function store(StoreAnnadanamRequest $request)
    {
        $annadanam = Annadanam::create($request->all());

        return redirect()->route('admin.annadanams.index');
    }

    public function edit(Annadanam $annadanam)
    {
        abort_if(Gate::denies('annadanam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.annadanams.edit', compact('annadanam'));
    }

    public function update(UpdateAnnadanamRequest $request, Annadanam $annadanam)
    {
        $annadanam->update($request->all());

        return redirect()->route('admin.annadanams.index');
    }

    public function show(Annadanam $annadanam)
    {
        abort_if(Gate::denies('annadanam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.annadanams.show', compact('annadanam'));
    }

    public function destroy(Annadanam $annadanam)
    {
        abort_if(Gate::denies('annadanam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $annadanam->delete();

        return back();
    }

    public function massDestroy(MassDestroyAnnadanamRequest $request)
    {
        $annadanams = Annadanam::find(request('ids'));

        foreach ($annadanams as $annadanam) {
            $annadanam->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
