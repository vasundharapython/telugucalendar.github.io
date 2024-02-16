<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDayRequest;
use App\Http\Requests\StoreDayRequest;
use App\Http\Requests\UpdateDayRequest;
use App\Models\Day;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DaysController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('day_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Day::query()->select(sprintf('%s.*', (new Day)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'day_show';
                $editGate      = 'day_edit';
                $deleteGate    = 'day_delete';
                $crudRoutePart = 'days';

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

            $table->editColumn('suryodayam', function ($row) {
                return $row->suryodayam ? $row->suryodayam : '';
            });
            $table->editColumn('suryastamam', function ($row) {
                return $row->suryastamam ? $row->suryastamam : '';
            });
            $table->editColumn('thidhi', function ($row) {
                return $row->thidhi ? $row->thidhi : '';
            });
            $table->editColumn('nakshatram', function ($row) {
                return $row->nakshatram ? $row->nakshatram : '';
            });
            $table->editColumn('rahukalam', function ($row) {
                return $row->rahukalam ? $row->rahukalam : '';
            });
            $table->editColumn('yamagandam', function ($row) {
                return $row->yamagandam ? $row->yamagandam : '';
            });
            $table->editColumn('durmuhurtham', function ($row) {
                return $row->durmuhurtham ? $row->durmuhurtham : '';
            });
            $table->editColumn('varjyamu', function ($row) {
                return $row->varjyamu ? $row->varjyamu : '';
            });
            $table->editColumn('heading', function ($row) {
                return $row->heading ? $row->heading : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.days.index');
    }

    public function create()
    {
        abort_if(Gate::denies('day_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.days.create');
    }

    public function store(StoreDayRequest $request)
    {
        $day = Day::create($request->all());

        return redirect()->route('admin.days.index');
    }

    public function edit(Day $day)
    {
        abort_if(Gate::denies('day_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.days.edit', compact('day'));
    }

    public function update(UpdateDayRequest $request, Day $day)
    {
        $day->update($request->all());

        return redirect()->route('admin.days.index');
    }

    public function show(Day $day)
    {
        abort_if(Gate::denies('day_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.days.show', compact('day'));
    }

    public function destroy(Day $day)
    {
        abort_if(Gate::denies('day_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $day->delete();

        return back();
    }

    public function massDestroy(MassDestroyDayRequest $request)
    {
        $days = Day::find(request('ids'));

        foreach ($days as $day) {
            $day->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
