@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.jobRole.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.job-roles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="job_category_id">{{ trans('cruds.jobRole.fields.job_category') }}</label>
                <select class="form-control select2 {{ $errors->has('job_category') ? 'is-invalid' : '' }}" name="job_category_id" id="job_category_id" required>
                    @foreach($job_categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('job_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job_category'))
                    <span class="text-danger">{{ $errors->first('job_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.jobRole.fields.job_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="job_role">{{ trans('cruds.jobRole.fields.job_role') }}</label>
                <input class="form-control {{ $errors->has('job_role') ? 'is-invalid' : '' }}" type="text" name="job_role" id="job_role" value="{{ old('job_role', '') }}" required>
                @if($errors->has('job_role'))
                    <span class="text-danger">{{ $errors->first('job_role') }}</span>
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



@endsection