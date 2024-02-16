@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.month.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.months.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="month">{{ trans('cruds.month.fields.month') }}</label>
                            <input class="form-control" type="text" name="month" id="month" value="{{ old('month', '') }}">
                            @if($errors->has('month'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('month') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.month.fields.month_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="date">{{ trans('cruds.month.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date') }}">
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.month.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pandugalu">{{ trans('cruds.month.fields.pandugalu') }}</label>
                            <input class="form-control" type="text" name="pandugalu" id="pandugalu" value="{{ old('pandugalu', '') }}">
                            @if($errors->has('pandugalu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pandugalu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.month.fields.pandugalu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="govtselavu">{{ trans('cruds.month.fields.govtselavu') }}</label>
                            <input class="form-control" type="text" name="govtselavu" id="govtselavu" value="{{ old('govtselavu', '') }}">
                            @if($errors->has('govtselavu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('govtselavu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.month.fields.govtselavu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="upavasalu">{{ trans('cruds.month.fields.upavasalu') }}</label>
                            <input class="form-control" type="text" name="upavasalu" id="upavasalu" value="{{ old('upavasalu', '') }}">
                            @if($errors->has('upavasalu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('upavasalu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.month.fields.upavasalu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="importantdays">{{ trans('cruds.month.fields.importantdays') }}</label>
                            <input class="form-control" type="text" name="importantdays" id="importantdays" value="{{ old('importantdays', '') }}">
                            @if($errors->has('importantdays'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('importantdays') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.month.fields.importantdays_helper') }}</span>
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