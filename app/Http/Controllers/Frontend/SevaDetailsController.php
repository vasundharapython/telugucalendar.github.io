<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySevaDetailRequest;
use App\Http\Requests\StoreSevaDetailRequest;
use App\Models\SevaDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SevaDetailsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('seva_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sevaDetails = SevaDetail::all();

        return view('frontend.sevaDetails.index', compact('sevaDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('seva_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.sevaDetails.create');
    }

    public function store(StoreSevaDetailRequest $request)
    {
        $sevaDetail = SevaDetail::create($request->all());

        return redirect()->route('frontend.seva-details.index');
    }

    public function destroy(SevaDetail $sevaDetail)
    {
        abort_if(Gate::denies('seva_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sevaDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroySevaDetailRequest $request)
    {
        $sevaDetails = SevaDetail::find(request('ids'));

        foreach ($sevaDetails as $sevaDetail) {
            $sevaDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
