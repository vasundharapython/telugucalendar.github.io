<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJobApplicationRequest;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Models\JobApplication;
use App\Models\JobRole;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('job_application_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobApplications = JobApplication::with(['job_profile', 'media'])->get();

        return view('frontend.jobApplications.index', compact('jobApplications'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_application_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_profiles = JobRole::pluck('job_role', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.jobApplications.create', compact('job_profiles'));
    }

    public function store(StoreJobApplicationRequest $request)
    {
        $jobApplication = JobApplication::create($request->all());

        if ($request->input('file', false)) {
            $jobApplication->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $jobApplication->id]);
        }

        return redirect()->route('frontend.job-applications.index');
    }

    public function destroy(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobApplication->delete();

        return back();
    }

    public function massDestroy(MassDestroyJobApplicationRequest $request)
    {
        $jobApplications = JobApplication::find(request('ids'));

        foreach ($jobApplications as $jobApplication) {
            $jobApplication->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('job_application_create') && Gate::denies('job_application_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new JobApplication();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
