<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySthothraluSubCategoryRequest;
use App\Http\Requests\StoreSthothraluSubCategoryRequest;
use App\Http\Requests\UpdateSthothraluSubCategoryRequest;
use App\Models\SthothraluSubCategory;
use App\Models\SthotraluCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class SthothraluSubCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sthothralu_sub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SthothraluSubCategory::with(['subcategory'])->select(sprintf('%s.*', (new SthothraluSubCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'sthothralu_sub_category_show';
                $editGate      = 'sthothralu_sub_category_edit';
                $deleteGate    = 'sthothralu_sub_category_delete';
                $crudRoutePart = 'sthothralu-sub-categories';

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
            $table->addColumn('subcategory_category', function ($row) {
                return $row->subcategory ? $row->subcategory->category : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'subcategory']);

            return $table->make(true);
        }

        return view('admin.sthothraluSubCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sthothralu_sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategories = SthotraluCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sthothraluSubCategories.create', compact('subcategories'));
    }

    public function store(StoreSthothraluSubCategoryRequest $request)
    {
        $sthothraluSubCategory = SthothraluSubCategory::create($request->all());
        $slug = SlugService::createSlug(SthothraluSubCategory::class, 'slug', $request->subcategory_id);
        $sthothraluSubCategory->slug = $slug;
        $sthothraluSubCategory->save();

        return redirect()->route('admin.sthothralu-sub-categories.index');
    }

    public function edit(SthothraluSubCategory $sthothraluSubCategory)
    {
        abort_if(Gate::denies('sthothralu_sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subcategories = SthotraluCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sthothraluSubCategory->load('subcategory');

        return view('admin.sthothraluSubCategories.edit', compact('sthothraluSubCategory', 'subcategories'));
    }

    public function update(UpdateSthothraluSubCategoryRequest $request, SthothraluSubCategory $sthothraluSubCategory)
    {
        $sthothraluSubCategory->update($request->all());

        return redirect()->route('admin.sthothralu-sub-categories.index');
    }

    public function show(SthothraluSubCategory $sthothraluSubCategory)
    {
        abort_if(Gate::denies('sthothralu_sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sthothraluSubCategory->load('subcategory', 'categorySthotralus');

        return view('admin.sthothraluSubCategories.show', compact('sthothraluSubCategory'));
    }

    public function destroy(SthothraluSubCategory $sthothraluSubCategory)
    {
        abort_if(Gate::denies('sthothralu_sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sthothraluSubCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroySthothraluSubCategoryRequest $request)
    {
        $sthothraluSubCategories = SthothraluSubCategory::find(request('ids'));

        foreach ($sthothraluSubCategories as $sthothraluSubCategory) {
            $sthothraluSubCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
