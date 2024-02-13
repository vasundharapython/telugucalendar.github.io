<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobCreationRequest;
use App\Http\Requests\UpdateJobCreationRequest;
use App\Http\Resources\Admin\JobCreationResource;
use App\Models\JobCreation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobCreationApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_creation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobCreationResource(JobCreation::with(['job_category', 'job_role'])->get());
    }

    public function store(StoreJobCreationRequest $request)
    {
        $jobCreation = JobCreation::create($request->all());

        return (new JobCreationResource($jobCreation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JobCreation $jobCreation)
    {
        abort_if(Gate::denies('job_creation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobCreationResource($jobCreation->load(['job_category', 'job_role']));
    }

    public function update(UpdateJobCreationRequest $request, JobCreation $jobCreation)
    {
        $jobCreation->update($request->all());

        return (new JobCreationResource($jobCreation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JobCreation $jobCreation)
    {
        abort_if(Gate::denies('job_creation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobCreation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
