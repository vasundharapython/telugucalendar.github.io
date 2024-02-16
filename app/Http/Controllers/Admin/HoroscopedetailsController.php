<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHoroscopedetailRequest;
use App\Http\Requests\StoreHoroscopedetailRequest;
use App\Http\Requests\UpdateHoroscopedetailRequest;
use App\Models\Horoscopedetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HoroscopedetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('horoscopedetail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Horoscopedetail::query()->select(sprintf('%s.*', (new Horoscopedetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'horoscopedetail_show';
                $editGate      = 'horoscopedetail_edit';
                $deleteGate    = 'horoscopedetail_delete';
                $crudRoutePart = 'horoscopedetails';

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
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });

            $table->editColumn('time_of_birth', function ($row) {
                return $row->time_of_birth ? $row->time_of_birth : '';
            });
            $table->editColumn('place_of_birth', function ($row) {
                return $row->place_of_birth ? $row->place_of_birth : '';
            });
            $table->editColumn('problem_details', function ($row) {
                return $row->problem_details ? $row->problem_details : '';
            });
            $table->editColumn('contact_details', function ($row) {
                return $row->contact_details ? $row->contact_details : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.horoscopedetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('horoscopedetail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.horoscopedetails.create');
    }

    public function store(StoreHoroscopedetailRequest $request)
    {
        $horoscopedetail = Horoscopedetail::create($request->all());

        return redirect()->route('admin.horoscopedetails.index');
    }

    public function edit(Horoscopedetail $horoscopedetail)
    {
        abort_if(Gate::denies('horoscopedetail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.horoscopedetails.edit', compact('horoscopedetail'));
    }

    public function update(UpdateHoroscopedetailRequest $request, Horoscopedetail $horoscopedetail)
    {
        $horoscopedetail->update($request->all());

        return redirect()->route('admin.horoscopedetails.index');
    }

    public function show(Horoscopedetail $horoscopedetail)
    {
        abort_if(Gate::denies('horoscopedetail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.horoscopedetails.show', compact('horoscopedetail'));
    }

    public function destroy(Horoscopedetail $horoscopedetail)
    {
        abort_if(Gate::denies('horoscopedetail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $horoscopedetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyHoroscopedetailRequest $request)
    {
        $horoscopedetails = Horoscopedetail::find(request('ids'));

        foreach ($horoscopedetails as $horoscopedetail) {
            $horoscopedetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
