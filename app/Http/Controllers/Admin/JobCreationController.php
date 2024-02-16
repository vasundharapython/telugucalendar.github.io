<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyJobCreationRequest;
use App\Http\Requests\StoreJobCreationRequest;
use App\Http\Requests\UpdateJobCreationRequest;
use App\Models\JobCategory;
use App\Models\JobCreation;
use App\Models\JobRole;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class JobCreationController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('job_creation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = JobCreation::with(['job_category', 'job_role'])->select(sprintf('%s.*', (new JobCreation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'job_creation_show';
                $editGate      = 'job_creation_edit';
                $deleteGate    = 'job_creation_delete';
                $crudRoutePart = 'job-creations';

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
            $table->editColumn('job', function ($row) {
                return $row->job ? $row->job : '';
            });
            $table->addColumn('job_category_category', function ($row) {
                return $row->job_category ? $row->job_category->category : '';
            });

            $table->addColumn('job_role_job_role', function ($row) {
                return $row->job_role ? $row->job_role->job_role : '';
            });

            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
            $table->editColumn('job_description', function ($row) {
                return $row->job_description ? $row->job_description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'job_category', 'job_role']);

            return $table->make(true);
        }

        return view('admin.jobCreations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('job_creation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $job_roles = JobRole::pluck('job_role', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.jobCreations.create', compact('job_categories', 'job_roles'));
    }

    public function store(StoreJobCreationRequest $request)
    {
        $jobCreation = JobCreation::create($request->all());
        $id = IdGenerator::generate(['table'=>'job_creations','field' => 'job','length' => '10', 'prefix'=>'HDC']);
        $jobCreation->job = $id;
        $jobCreation->save();

        return redirect()->route('admin.job-creations.index');
    }

    public function edit(JobCreation $jobCreation)
    {
        abort_if(Gate::denies('job_creation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $job_roles = JobRole::pluck('job_role', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobCreation->load('job_category', 'job_role');

        return view('admin.jobCreations.edit', compact('jobCreation', 'job_categories', 'job_roles'));
    }

    public function update(UpdateJobCreationRequest $request, JobCreation $jobCreation)
    {
        $jobCreation->update($request->all());

        return redirect()->route('admin.job-creations.index');
    }

    public function show(JobCreation $jobCreation)
    {
        abort_if(Gate::denies('job_creation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobCreation->load('job_category', 'job_role');

        return view('admin.jobCreations.show', compact('jobCreation'));
    }

    public function destroy(JobCreation $jobCreation)
    {
        abort_if(Gate::denies('job_creation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobCreation->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobCreationRequest $request)
    {
        $jobCreations = JobCreation::find(request('ids'));

        foreach ($jobCreations as $jobCreation) {
            $jobCreation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
