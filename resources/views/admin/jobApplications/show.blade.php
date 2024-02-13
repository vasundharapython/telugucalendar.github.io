@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jobApplication.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-applications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.id') }}
                        </th>
                        <td>
                            {{ $jobApplication->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.job') }}
                        </th>
                        <td>
                            {{ $jobApplication->job }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.job_profile') }}
                        </th>
                        <td>
                            {{ $jobApplication->job_profile->job_role ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.name') }}
                        </th>
                        <td>
                            {{ $jobApplication->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.phone_no') }}
                        </th>
                        <td>
                            {{ $jobApplication->phone_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.email') }}
                        </th>
                        <td>
                            {{ $jobApplication->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.file') }}
                        </th>
                        <td>
                            @if($jobApplication->file)
                                <a href="{{ $jobApplication->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-applications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
