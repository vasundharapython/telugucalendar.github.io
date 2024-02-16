<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVedasDetailRequest;
use App\Http\Requests\StoreVedasDetailRequest;
use App\Models\VedasDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VedasDetailsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('vedas_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasDetails = VedasDetail::all();

        return view('frontend.vedasDetails.index', compact('vedasDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('vedas_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.vedasDetails.create');
    }

    public function store(StoreVedasDetailRequest $request)
    {
        $vedasDetail = VedasDetail::create($request->all());

        return redirect()->route('frontend.vedas-details.index');
    }

    public function destroy(VedasDetail $vedasDetail)
    {
        abort_if(Gate::denies('vedas_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vedasDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyVedasDetailRequest $request)
    {
        $vedasDetails = VedasDetail::find(request('ids'));

        foreach ($vedasDetails as $vedasDetail) {
            $vedasDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
