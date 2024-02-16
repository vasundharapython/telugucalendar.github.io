<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySthotraluCategoryRequest;
use App\Http\Requests\StoreSthotraluCategoryRequest;
use App\Http\Requests\UpdateSthotraluCategoryRequest;
use App\Models\SthotraluCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SthotraluCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sthotralu_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SthotraluCategory::query()->select(sprintf('%s.*', (new SthotraluCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sthotralu_category_show';
                $editGate      = 'sthotralu_category_edit';
                $deleteGate    = 'sthotralu_category_delete';
                $crudRoutePart = 'sthotralu-categories';

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
            $table->editColumn('category', function ($row) {
                return $row->category ? $row->category : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.sthotraluCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sthotralu_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sthotraluCategories.create');
    }

    public function store(StoreSthotraluCategoryRequest $request)
    {
        $sthotraluCategory = SthotraluCategory::create($request->all());
        $slug = SlugService::createSlug(SthotraluCategory::class, 'slug', $request->category);
        $sthotraluCategory->slug = $slug;
        $sthotraluCategory->save();

        return redirect()->route('admin.sthotralu-categories.index');
    }

    public function edit(SthotraluCategory $sthotraluCategory)
    {
        abort_if(Gate::denies('sthotralu_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sthotraluCategories.edit', compact('sthotraluCategory'));
    }

    public function update(UpdateSthotraluCategoryRequest $request, SthotraluCategory $sthotraluCategory)
    {
        $sthotraluCategory->update($request->all());

        return redirect()->route('admin.sthotralu-categories.index');
    }

    public function show(SthotraluCategory $sthotraluCategory)
    {
        abort_if(Gate::denies('sthotralu_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sthotraluCategory->load('categorySthotralus');

        return view('admin.sthotraluCategories.show', compact('sthotraluCategory'));
    }

    public function destroy(SthotraluCategory $sthotraluCategory)
    {
        abort_if(Gate::denies('sthotralu_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sthotraluCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroySthotraluCategoryRequest $request)
    {
        $sthotraluCategories = SthotraluCategory::find(request('ids'));

        foreach ($sthotraluCategories as $sthotraluCategory) {
            $sthotraluCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
