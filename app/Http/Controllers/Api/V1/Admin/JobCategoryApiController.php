<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobCategoryRequest;
use App\Http\Requests\UpdateJobCategoryRequest;
use App\Http\Resources\Admin\JobCategoryResource;
use App\Models\JobCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobCategoryResource(JobCategory::all());
    }

    public function store(StoreJobCategoryRequest $request)
    {
        $jobCategory = JobCategory::create($request->all());

        return (new JobCategoryResource($jobCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JobCategory $jobCategory)
    {
        abort_if(Gate::denies('job_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobCategoryResource($jobCategory);
    }

    public function update(UpdateJobCategoryRequest $request, JobCategory $jobCategory)
    {
        $jobCategory->update($request->all());

        return (new JobCategoryResource($jobCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JobCategory $jobCategory)
    {
        abort_if(Gate::denies('job_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
