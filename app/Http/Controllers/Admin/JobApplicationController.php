<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyJobApplicationRequest;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use App\Models\JobApplication;
use App\Models\JobRole;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class JobApplicationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('job_application_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = JobApplication::with(['job_profile'])->select(sprintf('%s.*', (new JobApplication)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'job_application_show';
                $editGate      = 'job_application_edit';
                $deleteGate    = 'job_application_delete';
                $crudRoutePart = 'job-applications';

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
            $table->addColumn('job_profile_job_role', function ($row) {
                return $row->job_profile ? $row->job_profile->job_role : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('phone_no', function ($row) {
                return $row->phone_no ? $row->phone_no : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('file', function ($row) {
                return $row->file ? '<a href="' . $row->file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'job_profile', 'file']);

            return $table->make(true);
        }

        return view('admin.jobApplications.index');
    }

    public function create()
    {
        abort_if(Gate::denies('job_application_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_profiles = JobRole::pluck('job_role', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.jobApplications.create', compact('job_profiles'));
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

        return redirect()->route('admin.job-applications.index');
    }

    public function edit(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job_profiles = JobRole::pluck('job_role', 'id')->prepend(trans('global.pleaseSelect'), '');

        $jobApplication->load('job_profile');

        return view('admin.jobApplications.edit', compact('jobApplication', 'job_profiles'));
    }

    public function update(UpdateJobApplicationRequest $request, JobApplication $jobApplication)
    {
        $jobApplication->update($request->all());

        if ($request->input('file', false)) {
            if (! $jobApplication->file || $request->input('file') !== $jobApplication->file->file_name) {
                if ($jobApplication->file) {
                    $jobApplication->file->delete();
                }
                $jobApplication->addMedia(storage_path('tmp/uploads/' . basename($request->input('file'))))->toMediaCollection('file');
            }
        } elseif ($jobApplication->file) {
            $jobApplication->file->delete();
        }

        return redirect()->route('admin.job-applications.index');
    }

    public function show(JobApplication $jobApplication)
    {
        abort_if(Gate::denies('job_application_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobApplication->load('job_profile');

        return view('admin.jobApplications.show', compact('jobApplication'));
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
