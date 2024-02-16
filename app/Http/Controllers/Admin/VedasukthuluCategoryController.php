<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVedasukthuluCategoryRequest;
use App\Http\Requests\StoreVedasukthuluCategoryRequest;
use App\Http\Requests\UpdateVedasukthuluCategoryRequest;
use App\Models\VedasukthuluCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class VedasukthuluCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vedasukthulu_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VedasukthuluCategory::query()->select(sprintf('%s.*', (new VedasukthuluCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vedasukthulu_category_show';
                $editGate      = 'vedasukthulu_category_edit';
                $deleteGate    = 'vedasukthulu_category_delete';
                $crudRoutePart = 'vedasukthulu-categories';

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

        return view('admin.vedasukthuluCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vedasukthulu_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vedasukthuluCategories.create');
    }

    public function store(StoreVedasukthuluCategoryRequest $request)
    {
        $vedasukthuluCategory = VedasukthuluCategory::create($request->all());
        $slug = SlugService::createSlug(VedasukthuluCategory::class, 'slug', $request->title);
        $vedasukthuluCategory->slug = $slug;
        $vedasukthuluCategory->save();

        return redirect()->route('admin.vedasukthulu-categories.index');
    }

    public function edit(VedasukthuluCategory $vedasukthuluCategory)
    {
        abort_if(Gate::denies('vedasukthulu_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vedasukthuluCategories.edit', compact('vedasukthuluCategory'));
    }

    public function update(UpdateVedasukthuluCategoryRequest $request, VedasukthuluCategory $vedasukthuluCategory)
    {
        $vedasukthuluCategory->update($request->all());

        return redirect()->route('admin.vedasukthulu-categories.index');
    }

    public function show(VedasukthuluCategory $vedasukthuluCategory)
    {
        abort_if(Gate::denies('vedasukthulu_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasukthuluCategory->load('categoryVedasukthuluSubCategories');

        return view('admin.vedasukthuluCategories.show', compact('vedasukthuluCategory'));
    }

    public function destroy(VedasukthuluCategory $vedasukthuluCategory)
    {
        abort_if(Gate::denies('vedasukthulu_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasukthuluCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyVedasukthuluCategoryRequest $request)
    {
        $vedasukthuluCategories = VedasukthuluCategory::find(request('ids'));

        foreach ($vedasukthuluCategories as $vedasukthuluCategory) {
            $vedasukthuluCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
