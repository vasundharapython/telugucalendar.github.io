<?php

namespace App\Http\Controllers\Frontend;

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

class JobCreationController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('job_creation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobCreations = JobCreation::with(['job_category', 'job_role'])->get();

        return view('frontend.jobCreations.index', compact('jobCreations'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_creation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $job_roles = JobRole::pluck('job_role', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.jobCreations.create', compact('job_categories', 'job_roles'));
    }

    public function store(StoreJobCreationRequest $request)
    {
        $jobCreation = JobCreation::create($request->all());

        return redirect()->route('frontend.job-creations.index');
    }

    public function edit(JobCreation $jobCreation)
    {
        abort_if(Gate::denies('job_creation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_categories = JobCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $job_roles = JobRole::pluck('job_role', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobCreation->load('job_category', 'job_role');

        return view('frontend.jobCreations.edit', compact('jobCreation', 'job_categories', 'job_roles'));
    }

    public function update(UpdateJobCreationRequest $request, JobCreation $jobCreation)
    {
        $jobCreation->update($request->all());

        return redirect()->route('frontend.job-creations.index');
    }

    public function show(JobCreation $jobCreation)
    {
        abort_if(Gate::denies('job_creation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobCreation->load('job_category', 'job_role');

        return view('frontend.jobCreations.show', compact('jobCreation'));
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
