@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.pujaBooking.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.puja-bookings.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.pujaBooking.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pujaBooking.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="gotram">{{ trans('cruds.pujaBooking.fields.gotram') }}</label>
                            <input class="form-control" type="text" name="gotram" id="gotram" value="{{ old('gotram', '') }}" required>
                            @if($errors->has('gotram'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gotram') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pujaBooking.fields.gotram_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="phone_no">{{ trans('cruds.pujaBooking.fields.phone_no') }}</label>
                            <input class="form-control" type="text" name="phone_no" id="phone_no" value="{{ old('phone_no', '') }}" required>
                            @if($errors->has('phone_no'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone_no') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pujaBooking.fields.phone_no_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.pujaBooking.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pujaBooking.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="address">{{ trans('cruds.pujaBooking.fields.address') }}</label>
                            <textarea class="form-control" name="address" id="address" required>{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pujaBooking.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="requirement_of_puja">{{ trans('cruds.pujaBooking.fields.requirement_of_puja') }}</label>
                            <textarea class="form-control" name="requirement_of_puja" id="requirement_of_puja">{{ old('requirement_of_puja') }}</textarea>
                            @if($errors->has('requirement_of_puja'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('requirement_of_puja') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.pujaBooking.fields.requirement_of_puja_helper') }}</span>
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