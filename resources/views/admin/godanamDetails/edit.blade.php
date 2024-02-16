@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.godanamDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.godanam-details.update", [$godanamDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="full_name">{{ trans('cruds.godanamDetail.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', $godanamDetail->full_name) }}">
                @if($errors->has('full_name'))
                    <span class="text-danger">{{ $errors->first('full_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.godanamDetail.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_details">{{ trans('cruds.godanamDetail.fields.contact_details') }}</label>
                <input class="form-control {{ $errors->has('contact_details') ? 'is-invalid' : '' }}" type="text" name="contact_details" id="contact_details" value="{{ old('contact_details', $godanamDetail->contact_details) }}">
                @if($errors->has('contact_details'))
                    <span class="text-danger">{{ $errors->first('contact_details') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.godanamDetail.fields.contact_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.godanamDetail.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $godanamDetail->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.godanamDetail.fields.email_helper') }}</span>
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
