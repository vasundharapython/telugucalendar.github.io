<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVedasukthuluSubCategoryRequest;
use App\Http\Requests\StoreVedasukthuluSubCategoryRequest;
use App\Http\Requests\UpdateVedasukthuluSubCategoryRequest;
use App\Models\VedasukthuluCategory;
use App\Models\VedasukthuluSubCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class VedasukthuluSubCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vedasukthulu_sub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VedasukthuluSubCategory::with(['category'])->select(sprintf('%s.*', (new VedasukthuluSubCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vedasukthulu_sub_category_show';
                $editGate      = 'vedasukthulu_sub_category_edit';
                $deleteGate    = 'vedasukthulu_sub_category_delete';
                $crudRoutePart = 'vedasukthulu-sub-categories';

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
            $table->addColumn('category_title', function ($row) {
                return $row->category ? $row->category->title : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category']);

            return $table->make(true);
        }

        return view('admin.vedasukthuluSubCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vedasukthulu_sub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = VedasukthuluCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vedasukthuluSubCategories.create', compact('categories'));
    }

    public function store(StoreVedasukthuluSubCategoryRequest $request)
    {
        $vedasukthuluSubCategory = VedasukthuluSubCategory::create($request->all());
        $slug = SlugService::createSlug(VedasukthuluSubCategory::class, 'slug', $request->title);
        $vedasukthuluSubCategory->slug = $slug;
        $vedasukthuluSubCategory->save();

        return redirect()->route('admin.vedasukthulu-sub-categories.index');
    }

    public function edit(VedasukthuluSubCategory $vedasukthuluSubCategory)
    {
        abort_if(Gate::denies('vedasukthulu_sub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = VedasukthuluCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vedasukthuluSubCategory->load('category');

        return view('admin.vedasukthuluSubCategories.edit', compact('categories', 'vedasukthuluSubCategory'));
    }

    public function update(UpdateVedasukthuluSubCategoryRequest $request, VedasukthuluSubCategory $vedasukthuluSubCategory)
    {
        $vedasukthuluSubCategory->update($request->all());

        return redirect()->route('admin.vedasukthulu-sub-categories.index');
    }

    public function show(VedasukthuluSubCategory $vedasukthuluSubCategory)
    {
        abort_if(Gate::denies('vedasukthulu_sub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasukthuluSubCategory->load('category', 'subcategoryVedasukthulus');

        return view('admin.vedasukthuluSubCategories.show', compact('vedasukthuluSubCategory'));
    }

    public function destroy(VedasukthuluSubCategory $vedasukthuluSubCategory)
    {
        abort_if(Gate::denies('vedasukthulu_sub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasukthuluSubCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyVedasukthuluSubCategoryRequest $request)
    {
        $vedasukthuluSubCategories = VedasukthuluSubCategory::find(request('ids'));

        foreach ($vedasukthuluSubCategories as $vedasukthuluSubCategory) {
            $vedasukthuluSubCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
