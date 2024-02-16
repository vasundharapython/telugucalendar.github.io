<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyScategoryRequest;
use App\Http\Requests\StoreScategoryRequest;
use App\Http\Requests\UpdateScategoryRequest;
use App\Models\Scategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class ScategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('scategory_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Scategory::query()->select(sprintf('%s.*', (new Scategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'scategory_show';
                $editGate      = 'scategory_edit';
                $deleteGate    = 'scategory_delete';
                $crudRoutePart = 'scategories';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.scategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('scategory_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scategories.create');
    }

    public function store(StoreScategoryRequest $request)
    {
        $scategory = Scategory::create($request->all());
        $slug = SlugService::createSlug(Scategory::class, 'slug', $request->title);
        $scategory->slug = $slug;
        $scategory->save();

        return redirect()->route('admin.scategories.index');
    }

    public function edit(Scategory $scategory)
    {
        abort_if(Gate::denies('scategory_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.scategories.edit', compact('scategory'));
    }

    public function update(UpdateScategoryRequest $request, Scategory $scategory)
    {
        $scategory->update($request->all());

        return redirect()->route('admin.scategories.index');
    }

    public function show(Scategory $scategory)
    {
        abort_if(Gate::denies('scategory_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scategory->load('scategorySsubCategories');

        return view('admin.scategories.show', compact('scategory'));
    }

    public function destroy(Scategory $scategory)
    {
        abort_if(Gate::denies('scategory_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyScategoryRequest $request)
    {
        $scategories = Scategory::find(request('ids'));

        foreach ($scategories as $scategory) {
            $scategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
