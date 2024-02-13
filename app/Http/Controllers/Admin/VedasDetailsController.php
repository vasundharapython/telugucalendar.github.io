<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVedasDetailRequest;
use App\Http\Requests\StoreVedasDetailRequest;
use App\Http\Requests\UpdateVedasDetailRequest;
use App\Models\VedasDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VedasDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vedas_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VedasDetail::query()->select(sprintf('%s.*', (new VedasDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vedas_detail_show';
                $editGate      = 'vedas_detail_edit';
                $deleteGate    = 'vedas_detail_delete';
                $crudRoutePart = 'vedas-details';

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
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('contact_details', function ($row) {
                return $row->contact_details ? $row->contact_details : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.vedasDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vedas_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vedasDetails.create');
    }

    public function store(StoreVedasDetailRequest $request)
    {
        $vedasDetail = VedasDetail::create($request->all());

        return redirect()->route('admin.vedas-details.index');
    }

    public function edit(VedasDetail $vedasDetail)
    {
        abort_if(Gate::denies('vedas_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vedasDetails.edit', compact('vedasDetail'));
    }

    public function update(UpdateVedasDetailRequest $request, VedasDetail $vedasDetail)
    {
        $vedasDetail->update($request->all());

        return redirect()->route('admin.vedas-details.index');
    }

    public function show(VedasDetail $vedasDetail)
    {
        abort_if(Gate::denies('vedas_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vedasDetails.show', compact('vedasDetail'));
    }

    public function destroy(VedasDetail $vedasDetail)
    {
        abort_if(Gate::denies('vedas_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyVedasDetailRequest $request)
    {
        $vedasDetails = VedasDetail::find(request('ids'));

        foreach ($vedasDetails as $vedasDetail) {
            $vedasDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
