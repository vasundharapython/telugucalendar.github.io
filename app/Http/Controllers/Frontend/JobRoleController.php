<?php

namespace App\Http\Controllers\Frontend;

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

class JobRoleController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('job_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobRoles = JobRole::with(['job_category'])->get();

        return view('frontend.jobRoles.index', compact('jobRoles'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.jobRoles.create', compact('job_categories'));
    }

    public function store(StoreJobRoleRequest $request)
    {
        $jobRole = JobRole::create($request->all());

        return redirect()->route('frontend.job-roles.index');
    }

    public function edit(JobRole $jobRole)
    {
        abort_if(Gate::denies('job_role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobRole->load('job_category');

        return view('frontend.jobRoles.edit', compact('jobRole', 'job_categories'));
    }

    public function update(UpdateJobRoleRequest $request, JobRole $jobRole)
    {
        $jobRole->update($request->all());

        return redirect()->route('frontend.job-roles.index');
    }

    public function show(JobRole $jobRole)
    {
        abort_if(Gate::denies('job_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobRole->load('job_category');

        return view('frontend.jobRoles.show', compact('jobRole'));
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
