<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySsubCategoryRequest;
use App\Http\Requests\StoreSsubCategoryRequest;
use App\Http\Requests\UpdateSsubCategoryRequest;
use App\Models\Scategory;
use App\Models\SsubCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class SsubCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('ssub_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SsubCategory::with(['scategory'])->select(sprintf('%s.*', (new SsubCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'ssub_category_show';
                $editGate      = 'ssub_category_edit';
                $deleteGate    = 'ssub_category_delete';
                $crudRoutePart = 'ssub-categories';

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
            $table->addColumn('scategory_title', function ($row) {
                return $row->scategory ? $row->scategory->title : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'scategory']);

            return $table->make(true);
        }

        return view('admin.ssubCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ssub_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scategories = Scategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ssubCategories.create', compact('scategories'));
    }

    public function store(StoreSsubCategoryRequest $request)
    {
        $ssubCategory = SsubCategory::create($request->all());
        $slug = SlugService::createSlug(SsubCategory::class, 'slug', $request->title);
        $ssubCategory->slug = $slug;
        $ssubCategory->save();

        return redirect()->route('admin.ssub-categories.index');
    }

    public function edit(SsubCategory $ssubCategory)
    {
        abort_if(Gate::denies('ssub_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scategories = Scategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ssubCategory->load('scategory');

        return view('admin.ssubCategories.edit', compact('scategories', 'ssubCategory'));
    }

    public function update(UpdateSsubCategoryRequest $request, SsubCategory $ssubCategory)
    {
        $ssubCategory->update($request->all());

        return redirect()->route('admin.ssub-categories.index');
    }

    public function show(SsubCategory $ssubCategory)
    {
        abort_if(Gate::denies('ssub_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ssubCategory->load('scategory', 'ssubcategorySthothraluCopies');

        return view('admin.ssubCategories.show', compact('ssubCategory'));
    }

    public function destroy(SsubCategory $ssubCategory)
    {
        abort_if(Gate::denies('ssub_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ssubCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroySsubCategoryRequest $request)
    {
        $ssubCategories = SsubCategory::find(request('ids'));

        foreach ($ssubCategories as $ssubCategory) {
            $ssubCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
