<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBhakthiGeethaCategoryRequest;
use App\Http\Requests\StoreBhakthiGeethaCategoryRequest;
use App\Http\Requests\UpdateBhakthiGeethaCategoryRequest;
use App\Models\BhakthiGeethaCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class BhakthiGeethaCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bhakthi_geetha_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BhakthiGeethaCategory::query()->select(sprintf('%s.*', (new BhakthiGeethaCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bhakthi_geetha_category_show';
                $editGate      = 'bhakthi_geetha_category_edit';
                $deleteGate    = 'bhakthi_geetha_category_delete';
                $crudRoutePart = 'bhakthi-geetha-categories';

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

        return view('admin.bhakthiGeethaCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bhakthi_geetha_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bhakthiGeethaCategories.create');
    }

    public function store(StoreBhakthiGeethaCategoryRequest $request)
    {
        $bhakthiGeethaCategory = BhakthiGeethaCategory::create($request->all());
        $slug = SlugService::createSlug(BhakthiGeethaCategory::class, 'slug', $request->title);
        $bhakthiGeethaCategory->slug = $slug;
        $bhakthiGeethaCategory->save();

        return redirect()->route('admin.bhakthi-geetha-categories.index');
    }

    public function edit(BhakthiGeethaCategory $bhakthiGeethaCategory)
    {
        abort_if(Gate::denies('bhakthi_geetha_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bhakthiGeethaCategories.edit', compact('bhakthiGeethaCategory'));
    }

    public function update(UpdateBhakthiGeethaCategoryRequest $request, BhakthiGeethaCategory $bhakthiGeethaCategory)
    {
        $bhakthiGeethaCategory->update($request->all());

        return redirect()->route('admin.bhakthi-geetha-categories.index');
    }

    public function show(BhakthiGeethaCategory $bhakthiGeethaCategory)
    {
        abort_if(Gate::denies('bhakthi_geetha_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bhakthiGeethaCategories.show', compact('bhakthiGeethaCategory'));
    }

    public function destroy(BhakthiGeethaCategory $bhakthiGeethaCategory)
    {
        abort_if(Gate::denies('bhakthi_geetha_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bhakthiGeethaCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyBhakthiGeethaCategoryRequest $request)
    {
        $bhakthiGeethaCategories = BhakthiGeethaCategory::find(request('ids'));

        foreach ($bhakthiGeethaCategories as $bhakthiGeethaCategory) {
            $bhakthiGeethaCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}