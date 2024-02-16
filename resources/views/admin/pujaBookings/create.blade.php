@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pujaBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.puja-bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.pujaBooking.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pujaBooking.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('Date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="gotram">{{ trans('cruds.pujaBooking.fields.gotram') }}</label>
                <input class="form-control {{ $errors->has('gotram') ? 'is-invalid' : '' }}" type="text" name="gotram" id="gotram" value="{{ old('gotram', '') }}" required>
                @if($errors->has('gotram'))
                    <span class="text-danger">{{ $errors->first('gotram') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pujaBooking.fields.gotram_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_no">{{ trans('cruds.pujaBooking.fields.phone_no') }}</label>
                <input class="form-control {{ $errors->has('phone_no') ? 'is-invalid' : '' }}" type="text" name="phone_no" id="phone_no" value="{{ old('phone_no', '') }}" required>
                @if($errors->has('phone_no'))
                    <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pujaBooking.fields.phone_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.pujaBooking.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pujaBooking.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.pujaBooking.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address') }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pujaBooking.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="requirement_of_puja">{{ trans('cruds.pujaBooking.fields.requirement_of_puja') }}</label>
                <textarea class="form-control {{ $errors->has('requirement_of_puja') ? 'is-invalid' : '' }}" name="requirement_of_puja" id="requirement_of_puja">{{ old('requirement_of_puja') }}</textarea>
                @if($errors->has('requirement_of_puja'))
                    <span class="text-danger">{{ $errors->first('requirement_of_puja') }}</span>
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



@endsection
