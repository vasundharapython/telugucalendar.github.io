@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.day.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.days.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="date">{{ trans('cruds.day.fields.date') }}</label>
                            <input class="form-control date" type="text" name="date" id="date" value="{{ old('date') }}" required>
                            @if($errors->has('date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('date') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.date_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="suryodayam">{{ trans('cruds.day.fields.suryodayam') }}</label>
                            <input class="form-control timepicker" type="text" name="suryodayam" id="suryodayam" value="{{ old('suryodayam') }}" required>
                            @if($errors->has('suryodayam'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('suryodayam') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.suryodayam_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="suryastamam">{{ trans('cruds.day.fields.suryastamam') }}</label>
                            <input class="form-control timepicker" type="text" name="suryastamam" id="suryastamam" value="{{ old('suryastamam') }}" required>
                            @if($errors->has('suryastamam'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('suryastamam') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.suryastamam_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="shubasamayamulu">{{ trans('cruds.day.fields.shubasamayamulu') }}</label>
                            <input class="form-control" type="text" name="shubasamayamulu" id="shubasamayamulu" value="{{ old('shubasamayamulu', '') }}" required>
                            @if($errors->has('shubasamayamulu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('shubasamayamulu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.shubasamayamulu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="amruthagadiyalu">{{ trans('cruds.day.fields.amruthagadiyalu') }}</label>
                            <input class="form-control" type="text" name="amruthagadiyalu" id="amruthagadiyalu" value="{{ old('amruthagadiyalu', '') }}" required>
                            @if($errors->has('amruthagadiyalu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amruthagadiyalu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.amruthagadiyalu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="sygerionmuhurthalu">{{ trans('cruds.day.fields.sygerionmuhurthalu') }}</label>
                            <input class="form-control" type="text" name="sygerionmuhurthalu" id="sygerionmuhurthalu" value="{{ old('sygerionmuhurthalu', '') }}" required>
                            @if($errors->has('sygerionmuhurthalu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sygerionmuhurthalu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.sygerionmuhurthalu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="thidhi">{{ trans('cruds.day.fields.thidhi') }}</label>
                            <input class="form-control" type="text" name="thidhi" id="thidhi" value="{{ old('thidhi', '') }}" required>
                            @if($errors->has('thidhi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('thidhi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.thidhi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="nakshatram">{{ trans('cruds.day.fields.nakshatram') }}</label>
                            <input class="form-control" type="text" name="nakshatram" id="nakshatram" value="{{ old('nakshatram', '') }}" required>
                            @if($errors->has('nakshatram'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nakshatram') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.nakshatram_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="yogam">{{ trans('cruds.day.fields.yogam') }}</label>
                            <input class="form-control" type="text" name="yogam" id="yogam" value="{{ old('yogam', '') }}" required>
                            @if($errors->has('yogam'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('yogam') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.yogam_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="karanam">{{ trans('cruds.day.fields.karanam') }}</label>
                            <input class="form-control" type="text" name="karanam" id="karanam" value="{{ old('karanam', '') }}" required>
                            @if($errors->has('karanam'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('karanam') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.karanam_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="rahukalam">{{ trans('cruds.day.fields.rahukalam') }}</label>
                            <input class="form-control" type="text" name="rahukalam" id="rahukalam" value="{{ old('rahukalam', '') }}" required>
                            @if($errors->has('rahukalam'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rahukalam') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.rahukalam_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="yamagandam">{{ trans('cruds.day.fields.yamagandam') }}</label>
                            <input class="form-control" type="text" name="yamagandam" id="yamagandam" value="{{ old('yamagandam', '') }}" required>
                            @if($errors->has('yamagandam'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('yamagandam') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.yamagandam_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="durmuhurtham">{{ trans('cruds.day.fields.durmuhurtham') }}</label>
                            <input class="form-control" type="text" name="durmuhurtham" id="durmuhurtham" value="{{ old('durmuhurtham', '') }}" required>
                            @if($errors->has('durmuhurtham'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('durmuhurtham') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.durmuhurtham_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="varjyamu">{{ trans('cruds.day.fields.varjyamu') }}</label>
                            <input class="form-control" type="text" name="varjyamu" id="varjyamu" value="{{ old('varjyamu', '') }}" required>
                            @if($errors->has('varjyamu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('varjyamu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.day.fields.varjyamu_helper') }}</span>
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