@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.jobCreation.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.job-creations.update", [$jobCreation->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="job">{{ trans('cruds.jobCreation.fields.job') }}</label>
                            <input class="form-control" type="text" name="job" id="job" value="{{ old('job', $jobCreation->job) }}">
                            @if($errors->has('job'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobCreation.fields.job_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="job_category_id">{{ trans('cruds.jobCreation.fields.job_category') }}</label>
                            <select class="form-control select2" name="job_category_id" id="job_category_id">
                                @foreach($job_categories as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('job_category_id') ? old('job_category_id') : $jobCreation->job_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobCreation.fields.job_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="job_role_id">{{ trans('cruds.jobCreation.fields.job_role') }}</label>
                            <select class="form-control select2" name="job_role_id" id="job_role_id">
                                @foreach($job_roles as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('job_role_id') ? old('job_role_id') : $jobCreation->job_role->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('job_role'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_role') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobCreation.fields.job_role_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="location">{{ trans('cruds.jobCreation.fields.location') }}</label>
                            <input class="form-control" type="text" name="location" id="location" value="{{ old('location', $jobCreation->location) }}">
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobCreation.fields.location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="job_description">{{ trans('cruds.jobCreation.fields.job_description') }}</label>
                            <textarea class="form-control" name="job_description" id="job_description">{{ old('job_description', $jobCreation->job_description) }}</textarea>
                            @if($errors->has('job_description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.jobCreation.fields.job_description_helper') }}</span>
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