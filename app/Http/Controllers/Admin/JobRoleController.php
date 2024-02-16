<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyJobRoleRequest;
use App\Http\Requests\StoreJobRoleRequest;
use App\Http\Requests\UpdateJobRoleRequest;
use App\Models\JobCategory;
use App\Models\JobRole;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JobRoleController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('job_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = JobRole::with(['job_category'])->select(sprintf('%s.*', (new JobRole)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'job_role_show';
                $editGate      = 'job_role_edit';
                $deleteGate    = 'job_role_delete';
                $crudRoutePart = 'job-roles';

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
            $table->addColumn('job_category_category', function ($row) {
                return $row->job_category ? $row->job_category->category : '';
            });

            $table->editColumn('job_role', function ($row) {
                return $row->job_role ? $row->job_role : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'job_category']);

            return $table->make(true);
        }

        return view('admin.jobRoles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('job_role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.jobRoles.create', compact('job_categories'));
    }

    public function store(StoreJobRoleRequest $request)
    {
        $jobRole = JobRole::create($request->all());

        return redirect()->route('admin.job-roles.index');
    }

    public function edit(JobRole $jobRole)
    {
        abort_if(Gate::denies('job_role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobRole->load('job_category');

        return view('admin.jobRoles.edit', compact('jobRole', 'job_categories'));
    }

    public function update(UpdateJobRoleRequest $request, JobRole $jobRole)
    {
        $jobRole->update($request->all());

        return redirect()->route('admin.job-roles.index');
    }

    public function show(JobRole $jobRole)
    {
        abort_if(Gate::denies('job_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobRole->load('job_category');

        return view('admin.jobRoles.show', compact('jobRole'));
    }

    public function destroy(JobRole $jobRole)
    {
        abort_if(Gate::denies('job_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobRole->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobRoleRequest $request)
    {
        $jobRoles = JobRole::find(request('ids'));

        foreach ($jobRoles as $jobRole) {
            $jobRole->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
