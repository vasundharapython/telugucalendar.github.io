<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHoroscopedetailRequest;
use App\Http\Requests\StoreHoroscopedetailRequest;
use App\Models\Horoscopedetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HoroscopedetailsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('horoscopedetail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $horoscopedetails = Horoscopedetail::all();

        return view('frontend.horoscopedetails.index', compact('horoscopedetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('horoscopedetail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.horoscopedetails.create');
    }

    public function store(StoreHoroscopedetailRequest $request)
    {
        $horoscopedetail = Horoscopedetail::create($request->all());

        return redirect()->route('frontend.horoscopedetails.index');
    }

    public function destroy(Horoscopedetail $horoscopedetail)
    {
        abort_if(Gate::denies('horoscopedetail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $horoscopedetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyHoroscopedetailRequest $request)
    {
        $horoscopedetails = Horoscopedetail::find(request('ids'));

        foreach ($horoscopedetails as $horoscopedetail) {
            $horoscopedetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
