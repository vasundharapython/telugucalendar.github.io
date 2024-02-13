@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.jobCreation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.job-creations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="job_category_id">{{ trans('cruds.jobCreation.fields.job_category') }}</label>
                <select class="form-control select2 {{ $errors->has('job_category') ? 'is-invalid' : '' }}" name="job_category_id" id="job_category_id">
                    @foreach($job_categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('job_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_category'))
                    <span class="text-danger">{{ $errors->first('job_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jobCreation.fields.job_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="job_role_id">{{ trans('cruds.jobCreation.fields.job_role') }}</label>
                <select class="form-control select2 {{ $errors->has('job_role') ? 'is-invalid' : '' }}" name="job_role_id" id="job_role_id">
                    @foreach($job_roles as $id => $entry)
                        <option value="{{ $id }}" {{ old('job_role_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_role'))
                    <span class="text-danger">{{ $errors->first('job_role') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jobCreation.fields.job_role_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.jobCreation.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', '') }}">
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jobCreation.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="job_description">{{ trans('cruds.jobCreation.fields.job_description') }}</label>
                <textarea class="form-control {{ $errors->has('job_description') ? 'is-invalid' : '' }}" name="job_description" id="job_description">{{ old('job_description') }}</textarea>
                @if($errors->has('job_description'))
                    <span class="text-danger">{{ $errors->first('job_description') }}</span>
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



@endsection
