@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('Annadanam') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.annadanams.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="occasion">{{ trans('Occasion') }}</label>
                <input class="form-control {{ $errors->has('occasion') ? 'is-invalid' : '' }}" type="text" name="occasion" id="occasion" value="{{ old('occasion', '') }}" required>
                @if($errors->has('occasion'))
                    <span class="text-danger">{{ $errors->first('occasion') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('Full Name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <span class="text-danger">{{ $errors->first('full_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="gotram">{{ trans('Gotram') }}</label>
                <input class="form-control {{ $errors->has('gotram') ? 'is-invalid' : '' }}" type="text" name="gotram" id="gotram" value="{{ old('gotram', '') }}" required>
                @if($errors->has('gotram'))
                    <span class="text-danger">{{ $errors->first('gotram') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="star">{{ trans('Star') }}</label>
                <input class="form-control {{ $errors->has('star') ? 'is-invalid' : '' }}" type="text" name="star" id="star" value="{{ old('star', '') }}" required>
                @if($errors->has('star'))
                    <span class="text-danger">{{ $errors->first('star') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="residence">{{ trans('Residence') }}</label>
                <textarea class="form-control {{ $errors->has('Residence') ? 'is-invalid' : '' }}" type="text" name="residence" id="residence" value="{{ old('residence', '') }}" required></textarea>
                @if($errors->has('residence'))
                    <span class="text-danger">{{ $errors->first('residence') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="contact_details">{{ trans('Contact Details') }}</label>
                <input class="form-control {{ $errors->has('contact_details') ? 'is-invalid' : '' }}" type="text" name="contact_details" id="contact_details" value="{{ old('contact_details', '') }}" required>
                @if($errors->has('contact_details'))
                    <span class="text-danger">{{ $errors->first('contact_details') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('Date') }}</label>
                <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('Email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
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
