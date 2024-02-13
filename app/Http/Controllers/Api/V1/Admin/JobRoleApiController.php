<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRoleRequest;
use App\Http\Requests\UpdateJobRoleRequest;
use App\Http\Resources\Admin\JobRoleResource;
use App\Models\JobRole;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobRoleApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobRoleResource(JobRole::with(['job_category'])->get());
    }

    public function store(StoreJobRoleRequest $request)
    {
        $jobRole = JobRole::create($request->all());

        return (new JobRoleResource($jobRole))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JobRole $jobRole)
    {
        abort_if(Gate::denies('job_role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobRoleResource($jobRole->load(['job_category']));
    }

    public function update(UpdateJobRoleRequest $request, JobRole $jobRole)
    {
        $jobRole->update($request->all());

        return (new JobRoleResource($jobRole))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JobRole $jobRole)
    {
        abort_if(Gate::denies('job_role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobRole->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
