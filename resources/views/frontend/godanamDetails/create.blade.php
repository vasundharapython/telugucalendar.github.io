@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.godanamDetail.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.godanam-details.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="full_name">{{ trans('cruds.godanamDetail.fields.full_name') }}</label>
                            <input class="form-control" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}">
                            @if($errors->has('full_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('full_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.godanamDetail.fields.full_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="contact_details">{{ trans('cruds.godanamDetail.fields.contact_details') }}</label>
                            <input class="form-control" type="text" name="contact_details" id="contact_details" value="{{ old('contact_details', '') }}">
                            @if($errors->has('contact_details'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('contact_details') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.godanamDetail.fields.contact_details_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('cruds.godanamDetail.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection