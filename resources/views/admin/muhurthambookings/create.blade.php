@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.muhurthambooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.muhurthambookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.muhurthambooking.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <span class="text-danger">{{ $errors->first('full_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.muhurthambooking.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="spouse_name">{{ trans('cruds.muhurthambooking.fields.spouse_name') }}</label>
                <input class="form-control {{ $errors->has('spouse_name') ? 'is-invalid' : '' }}" type="text" name="spouse_name" id="spouse_name" value="{{ old('spouse_name', '') }}" required>
                @if($errors->has('spouse_name'))
                    <span class="text-danger">{{ $errors->first('spouse_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.muhurthambooking.fields.spouse_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="stars">{{ trans('cruds.muhurthambooking.fields.stars') }}</label>
                <input class="form-control {{ $errors->has('stars') ? 'is-invalid' : '' }}" type="text" name="stars" id="stars" value="{{ old('stars', '') }}" required>
                @if($errors->has('stars'))
                    <span class="text-danger">{{ $errors->first('stars') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.muhurthambooking.fields.stars_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="seeking_muhurtham">{{ trans('cruds.muhurthambooking.fields.seeking_muhurtham') }}</label>
                <input class="form-control timepicker {{ $errors->has('seeking_muhurtham') ? 'is-invalid' : '' }}" type="text" name="seeking_muhurtham" id="seeking_muhurtham" value="{{ old('seeking_muhurtham') }}" required>
                @if($errors->has('seeking_muhurtham'))
                    <span class="text-danger">{{ $errors->first('seeking_muhurtham') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.muhurthambooking.fields.seeking_muhurtham_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="place_of_muhurtham">{{ trans('cruds.muhurthambooking.fields.place_of_muhurtham') }}</label>
                <input class="form-control {{ $errors->has('place_of_muhurtham') ? 'is-invalid' : '' }}" type="text" name="place_of_muhurtham" id="place_of_muhurtham" value="{{ old('place_of_muhurtham', '') }}" required>
                @if($errors->has('place_of_muhurtham'))
                    <span class="text-danger">{{ $errors->first('place_of_muhurtham') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.muhurthambooking.fields.place_of_muhurtham_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_details">{{ trans('cruds.muhurthambooking.fields.contact_details') }}</label>
                <input class="form-control {{ $errors->has('contact_details') ? 'is-invalid' : '' }}" type="text" name="contact_details" id="contact_details" value="{{ old('contact_details', '') }}" required>
                @if($errors->has('contact_details'))
                    <span class="text-danger">{{ $errors->first('contact_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.muhurthambooking.fields.contact_details_helper') }}</span>
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