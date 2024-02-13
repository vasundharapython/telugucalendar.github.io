<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGodanamDetailRequest;
use App\Http\Requests\StoreGodanamDetailRequest;
use App\Models\GodanamDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GodanamDetailsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('godanam_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $godanamDetails = GodanamDetail::all();

        return view('frontend.godanamDetails.index', compact('godanamDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('godanam_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.godanamDetails.create');
    }

    public function store(StoreGodanamDetailRequest $request)
    {
        $godanamDetail = GodanamDetail::create($request->all());

        return redirect()->route('frontend.godanam-details.index');
    }

    public function destroy(GodanamDetail $godanamDetail)
    {
        abort_if(Gate::denies('godanam_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $godanamDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyGodanamDetailRequest $request)
    {
        $godanamDetails = GodanamDetail::find(request('ids'));

        foreach ($godanamDetails as $godanamDetail) {
            $godanamDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
