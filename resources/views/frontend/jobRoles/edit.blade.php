@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.jobRole.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.job-roles.update", [$jobRole->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="job_category_id">{{ trans('cruds.jobRole.fields.job_category') }}</label>
                            <select class="form-control select2" name="job_category_id" id="job_category_id" required>
                                @foreach($job_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('job_category_id') ? old('job_category_id') : $jobRole->job_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobRole.fields.job_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="job_role">{{ trans('cruds.jobRole.fields.job_role') }}</label>
                            <input class="form-control" type="text" name="job_role" id="job_role" value="{{ old('job_role', $jobRole->job_role) }}" required>
                            @if($errors->has('job_role'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_role') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobRole.fields.job_role_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection