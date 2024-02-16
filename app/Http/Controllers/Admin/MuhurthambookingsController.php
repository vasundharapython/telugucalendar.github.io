<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMuhurthambookingRequest;
use App\Http\Requests\StoreMuhurthambookingRequest;
use App\Http\Requests\UpdateMuhurthambookingRequest;
use App\Models\Muhurthambooking;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MuhurthambookingsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('muhurthambooking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Muhurthambooking::query()->select(sprintf('%s.*', (new Muhurthambooking)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'muhurthambooking_show';
                $editGate      = 'muhurthambooking_edit';
                $deleteGate    = 'muhurthambooking_delete';
                $crudRoutePart = 'muhurthambookings';

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
            $table->editColumn('spouse_name', function ($row) {
                return $row->spouse_name ? $row->spouse_name : '';
            });
            $table->editColumn('stars', function ($row) {
                return $row->stars ? $row->stars : '';
            });
            $table->editColumn('seeking_muhurtham', function ($row) {
                return $row->seeking_muhurtham ? $row->seeking_muhurtham : '';
            });
            $table->editColumn('place_of_muhurtham', function ($row) {
                return $row->place_of_muhurtham ? $row->place_of_muhurtham : '';
            });
            $table->editColumn('contact_details', function ($row) {
                return $row->contact_details ? $row->contact_details : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.muhurthambookings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('muhurthambooking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.muhurthambookings.create');
    }

    public function store(StoreMuhurthambookingRequest $request)
    {
        $muhurthambooking = Muhurthambooking::create($request->all());

        return redirect()->route('admin.muhurthambookings.index');
    }

    public function edit(Muhurthambooking $muhurthambooking)
    {
        abort_if(Gate::denies('muhurthambooking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.muhurthambookings.edit', compact('muhurthambooking'));
    }

    public function update(UpdateMuhurthambookingRequest $request, Muhurthambooking $muhurthambooking)
    {
        $muhurthambooking->update($request->all());

        return redirect()->route('admin.muhurthambookings.index');
    }

    public function show(Muhurthambooking $muhurthambooking)
    {
        abort_if(Gate::denies('muhurthambooking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.muhurthambookings.show', compact('muhurthambooking'));
    }

    public function destroy(Muhurthambooking $muhurthambooking)
    {
        abort_if(Gate::denies('muhurthambooking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $muhurthambooking->delete();

        return back();
    }

    public function massDestroy(MassDestroyMuhurthambookingRequest $request)
    {
        $muhurthambookings = Muhurthambooking::find(request('ids'));

        foreach ($muhurthambookings as $muhurthambooking) {
            $muhurthambooking->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
