<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOnlinepujadetailRequest;
use App\Http\Requests\StoreOnlinepujadetailRequest;
use App\Http\Requests\UpdateOnlinepujadetailRequest;
use App\Models\Onlinepujadetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OnlinepujadetailsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('onlinepujadetail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Onlinepujadetail::query()->select(sprintf('%s.*', (new Onlinepujadetail)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'onlinepujadetail_show';
                $editGate      = 'onlinepujadetail_edit';
                $deleteGate    = 'onlinepujadetail_delete';
                $crudRoutePart = 'onlinepujadetails';

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
            $table->editColumn('details_of_program', function ($row) {
                return $row->details_of_program ? $row->details_of_program : '';
            });
            $table->editColumn('place_of_program', function ($row) {
                return $row->place_of_program ? $row->place_of_program : '';
            });

            $table->editColumn('contact_details', function ($row) {
                return $row->contact_details ? $row->contact_details : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.onlinepujadetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('onlinepujadetail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.onlinepujadetails.create');
    }

    public function store(StoreOnlinepujadetailRequest $request)
    {
        $onlinepujadetail = Onlinepujadetail::create($request->all());

        return redirect()->route('admin.onlinepujadetails.index');
    }

    public function edit(Onlinepujadetail $onlinepujadetail)
    {
        abort_if(Gate::denies('onlinepujadetail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.onlinepujadetails.edit', compact('onlinepujadetail'));
    }

    public function update(UpdateOnlinepujadetailRequest $request, Onlinepujadetail $onlinepujadetail)
    {
        $onlinepujadetail->update($request->all());

        return redirect()->route('admin.onlinepujadetails.index');
    }

    public function show(Onlinepujadetail $onlinepujadetail)
    {
        abort_if(Gate::denies('onlinepujadetail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.onlinepujadetails.show', compact('onlinepujadetail'));
    }

    public function destroy(Onlinepujadetail $onlinepujadetail)
    {
        abort_if(Gate::denies('onlinepujadetail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $onlinepujadetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyOnlinepujadetailRequest $request)
    {
        $onlinepujadetails = Onlinepujadetail::find(request('ids'));

        foreach ($onlinepujadetails as $onlinepujadetail) {
            $onlinepujadetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
