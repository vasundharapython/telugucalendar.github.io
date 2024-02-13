<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddRequest;
use App\Http\Requests\StoreAddRequest;
use App\Http\Requests\UpdateAddRequest;
use App\Models\Add;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('add_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Add::query()->select(sprintf('%s.*', (new Add)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'add_show';
                $editGate      = 'add_edit';
                $deleteGate    = 'add_delete';
                $crudRoutePart = 'adds';

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

        return view('admin.adds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('add_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adds.create');
    }

    public function store(StoreAddRequest $request)
    {
        $add = Add::create($request->all());
        $imgPath = $request->file('image')->store('adds/','public');
        $add->image = $imgPath;
        $add->save();

        return redirect()->route('admin.adds.index');
    }

    public function edit(Add $add)
    {
        abort_if(Gate::denies('add_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adds.edit', compact('add'));
    }

    public function update(UpdateAddRequest $request, Add $add)
    {
        $add->update($request->all());
        if($request->hasFile('image')){
            $imgPath = $request->file('image')->store('adds/','public');
        }
        else{
            $imgPath = $request->prev_photo;
        }
        $add->image = $imgPath;
        $add->save();

        return redirect()->route('admin.adds.index');
    }

    public function show(Add $add)
    {
        abort_if(Gate::denies('add_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.adds.show', compact('add'));
    }

    public function destroy(Add $add)
    {
        abort_if(Gate::denies('add_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $add->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddRequest $request)
    {
        $adds = Add::find(request('ids'));

        foreach ($adds as $add) {
            $add->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
