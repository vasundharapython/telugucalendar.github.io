<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySevaDetailRequest;
use App\Http\Requests\StoreSevaDetailRequest;
use App\Models\SevaDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SevaDetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('seva_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SevaDetail::query()->select(sprintf('%s.*', (new SevaDetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'seva_detail_show';
                $editGate      = 'seva_detail_edit';
                $deleteGate    = 'seva_detail_delete';
                $crudRoutePart = 'seva-details';

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

        return view('admin.sevaDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('seva_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sevaDetails.create');
    }

    public function store(StoreSevaDetailRequest $request)
    {
        $sevaDetail = SevaDetail::create($request->all());

        return redirect()->route('admin.seva-details.index');
    }

    public function destroy(SevaDetail $sevaDetail)
    {
        abort_if(Gate::denies('seva_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sevaDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroySevaDetailRequest $request)
    {
        $sevaDetails = SevaDetail::find(request('ids'));

        foreach ($sevaDetails as $sevaDetail) {
            $sevaDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
