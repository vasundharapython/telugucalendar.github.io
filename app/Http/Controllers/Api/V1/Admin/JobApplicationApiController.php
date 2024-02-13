<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Resources\Admin\JobApplicationResource;
use App\Models\JobApplication;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('job_application_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobApplicationResource(JobApplication::with(['job_profile'])->get());
    }

    public function store(StoreJobApplicationRequest $request)
    {
        $jobApplication = JobApplication::create($request->all());

        if ($request->input('file', false)) {
            $jobApplication->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        return (new JobApplicationResource($jobApplication))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobApplication->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
