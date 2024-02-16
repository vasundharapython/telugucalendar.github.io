<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOnlinepujadetailRequest;
use App\Http\Requests\StoreOnlinepujadetailRequest;
use App\Models\Onlinepujadetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlinepujadetailsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('onlinepujadetail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $onlinepujadetails = Onlinepujadetail::all();

        return view('frontend.onlinepujadetails.index', compact('onlinepujadetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('onlinepujadetail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.onlinepujadetails.create');
    }

    public function store(StoreOnlinepujadetailRequest $request)
    {
        $onlinepujadetail = Onlinepujadetail::create($request->all());

        return redirect()->route('frontend.onlinepujadetails.index');
    }

    public function destroy(Onlinepujadetail $onlinepujadetail)
    {
        abort_if(Gate::denies('onlinepujadetail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $onlinepujadetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyOnlinepujadetailRequest $request)
    {
        $onlinepujadetails = Onlinepujadetail::find(request('ids'));

        foreach ($onlinepujadetails as $onlinepujadetail) {
            $onlinepujadetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
