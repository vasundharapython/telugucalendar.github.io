<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMonthRequest;
use App\Http\Requests\StoreMonthRequest;
use App\Http\Requests\UpdateMonthRequest;
use App\Models\Month;
use App\Models\Nelalu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Date;
use Carbon\Carbon;


class MonthController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('month_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Month::with(['month'])->select(sprintf('%s.*', (new Month)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'month_show';
                $editGate      = 'month_edit';
                $deleteGate    = 'month_delete';
                $crudRoutePart = 'months';

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
            $table->addColumn('month_month', function ($row) {
                return $row->month_id ? $row->month_id : '';
            });

            $table->editColumn('pandugalu', function ($row) {
                return $row->pandugalu ? $row->pandugalu : '';
            });
            $table->editColumn('govtselavu', function ($row) {
                return $row->govtselavu ? $row->govtselavu : '';
            });
            $table->editColumn('upavasalu', function ($row) {
                return $row->upavasalu ? $row->upavasalu : '';
            });
            $table->editColumn('importantdays', function ($row) {
                return $row->importantdays ? $row->importantdays : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'month']);

            return $table->make(true);
        }

        return view('admin.months.index');
    }

    public function create()
    {
        abort_if(Gate::denies('month_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Nelalu::pluck('month', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.months.create', compact('months'));
    }

    public function store(StoreMonthRequest $request)
    {

        // $requestDate = Carbon::parse($request->date);
        // $monthd = $requestDate->format('F');
        // //dd($monthd);
        $month = Month::create($request->all());
        // $slug = SlugService::createSlug(Month::class, 'slug', $monthd);
        // $month->slug = $slug;
        // $month->save();

        return redirect()->route('admin.months.index');
    }

    public function edit(Month $month)
    {
        abort_if(Gate::denies('month_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $months = Nelalu::pluck('month', 'id')->prepend(trans('global.pleaseSelect'), '');

        $month->load('month');

        return view('admin.months.edit', compact('month', 'months'));
    }

    public function update(UpdateMonthRequest $request, Month $month)
    {
        $month->update($request->all());

        return redirect()->route('admin.months.index');
    }

    public function show(Month $month)
    {
        abort_if(Gate::denies('month_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $month->load('month');

        return view('admin.months.show', compact('month'));
    }

    public function destroy(Month $month)
    {
        abort_if(Gate::denies('month_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $month->delete();

        return back();
    }

    public function massDestroy(MassDestroyMonthRequest $request)
    {
        $months = Month::find(request('ids'));

        foreach ($months as $month) {
            $month->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
