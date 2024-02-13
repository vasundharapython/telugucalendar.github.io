@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.horoscopedetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.horoscopedetails.update", [$horoscopedetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.horoscopedetail.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', $horoscopedetail->full_name) }}" required>
                @if($errors->has('full_name'))
                    <span class="text-danger">{{ $errors->first('full_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.horoscopedetail.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_of_birth">{{ trans('cruds.horoscopedetail.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $horoscopedetail->date_of_birth) }}" required>
                @if($errors->has('date_of_birth'))
                    <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.horoscopedetail.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="time_of_birth">{{ trans('cruds.horoscopedetail.fields.time_of_birth') }}</label>
                <input class="form-control timepicker {{ $errors->has('time_of_birth') ? 'is-invalid' : '' }}" type="text" name="time_of_birth" id="time_of_birth" value="{{ old('time_of_birth', $horoscopedetail->time_of_birth) }}" required>
                @if($errors->has('time_of_birth'))
                    <span class="text-danger">{{ $errors->first('time_of_birth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.horoscopedetail.fields.time_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="place_of_birth">{{ trans('cruds.horoscopedetail.fields.place_of_birth') }}</label>
                <input class="form-control {{ $errors->has('place_of_birth') ? 'is-invalid' : '' }}" type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth', $horoscopedetail->place_of_birth) }}" required>
                @if($errors->has('place_of_birth'))
                    <span class="text-danger">{{ $errors->first('place_of_birth') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.horoscopedetail.fields.place_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="problem_details">{{ trans('cruds.horoscopedetail.fields.problem_details') }}</label>
                <textarea class="form-control {{ $errors->has('problem_details') ? 'is-invalid' : '' }}" name="problem_details" id="problem_details" required>{{ old('problem_details', $horoscopedetail->problem_details) }}</textarea>
                @if($errors->has('problem_details'))
                    <span class="text-danger">{{ $errors->first('problem_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.horoscopedetail.fields.problem_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_details">{{ trans('cruds.horoscopedetail.fields.contact_details') }}</label>
                <input class="form-control {{ $errors->has('contact_details') ? 'is-invalid' : '' }}" type="text" name="contact_details" id="contact_details" value="{{ old('contact_details', $horoscopedetail->contact_details) }}" required>
                @if($errors->has('contact_details'))
                    <span class="text-danger">{{ $errors->first('contact_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.horoscopedetail.fields.contact_details_helper') }}</span>
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
