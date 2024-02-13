<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGodanamDetailRequest;
use App\Http\Requests\StoreGodanamDetailRequest;
use App\Http\Requests\UpdateGodanamDetailRequest;
use App\Models\GodanamDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GodanamDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('godanam_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GodanamDetail::query()->select(sprintf('%s.*', (new GodanamDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'godanam_detail_show';
                $editGate      = 'godanam_detail_edit';
                $deleteGate    = 'godanam_detail_delete';
                $crudRoutePart = 'godanam-details';

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
            $table->editColumn('contact_details', function ($row) {
                return $row->contact_details ? $row->contact_details : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.godanamDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('godanam_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.godanamDetails.create');
    }

    public function store(StoreGodanamDetailRequest $request)
    {
        $godanamDetail = GodanamDetail::create($request->all());

        return redirect()->route('admin.godanam-details.index');
    }

    public function edit(GodanamDetail $godanamDetail)
    {
        abort_if(Gate::denies('godanam_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.godanamDetails.edit', compact('godanamDetail'));
    }

    public function update(UpdateGodanamDetailRequest $request, GodanamDetail $godanamDetail)
    {
        $godanamDetail->update($request->all());

        return redirect()->route('admin.godanam-details.index');
    }

    public function show(GodanamDetail $godanamDetail)
    {
        abort_if(Gate::denies('godanam_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.godanamDetails.show', compact('godanamDetail'));
    }

    public function destroy(GodanamDetail $godanamDetail)
    {
        abort_if(Gate::denies('godanam_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $godanamDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyGodanamDetailRequest $request)
    {
        $godanamDetails = GodanamDetail::find(request('ids'));

        foreach ($godanamDetails as $godanamDetail) {
            $godanamDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
