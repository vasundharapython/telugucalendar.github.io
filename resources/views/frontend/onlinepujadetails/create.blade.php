@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.onlinepujadetail.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.onlinepujadetails.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="full_name">{{ trans('cruds.onlinepujadetail.fields.full_name') }}</label>
                            <input class="form-control" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                            @if($errors->has('full_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('full_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.onlinepujadetail.fields.full_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="details_of_program">{{ trans('cruds.onlinepujadetail.fields.details_of_program') }}</label>
                            <textarea class="form-control" name="details_of_program" id="details_of_program">{{ old('details_of_program') }}</textarea>
                            @if($errors->has('details_of_program'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('details_of_program') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.onlinepujadetail.fields.details_of_program_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="place_of_program">{{ trans('cruds.onlinepujadetail.fields.place_of_program') }}</label>
                            <input class="form-control" type="text" name="place_of_program" id="place_of_program" value="{{ old('place_of_program', '') }}">
                            @if($errors->has('place_of_program'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('place_of_program') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.onlinepujadetail.fields.place_of_program_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="date_time">{{ trans('cruds.onlinepujadetail.fields.date_time') }}</label>
                            <input class="form-control datetime" type="text" name="date_time" id="date_time" value="{{ old('date_time') }}" required>
                            @if($errors->has('date_time'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date_time') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.onlinepujadetail.fields.date_time_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_details">{{ trans('cruds.onlinepujadetail.fields.contact_details') }}</label>
                            <input class="form-control" type="text" name="contact_details" id="contact_details" value="{{ old('contact_details', '') }}">
                            @if($errors->has('contact_details'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_details') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.onlinepujadetail.fields.contact_details_helper') }}</span>
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