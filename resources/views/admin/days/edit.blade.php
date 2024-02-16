@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.day.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.days.update", [$day->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.day.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $day->date) }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="suryodayam">{{ trans('cruds.day.fields.suryodayam') }}</label>
                <input class="form-control timepicker {{ $errors->has('suryodayam') ? 'is-invalid' : '' }}" type="text" name="suryodayam" id="suryodayam" value="{{ old('suryodayam', $day->suryodayam) }}" required>
                @if($errors->has('suryodayam'))
                    <span class="text-danger">{{ $errors->first('suryodayam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.suryodayam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="suryastamam">{{ trans('cruds.day.fields.suryastamam') }}</label>
                <input class="form-control timepicker {{ $errors->has('suryastamam') ? 'is-invalid' : '' }}" type="text" name="suryastamam" id="suryastamam" value="{{ old('suryastamam', $day->suryastamam) }}" required>
                @if($errors->has('suryastamam'))
                    <span class="text-danger">{{ $errors->first('suryastamam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.suryastamam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="thidhi">{{ trans('cruds.day.fields.thidhi') }}</label>
                <input class="form-control {{ $errors->has('thidhi') ? 'is-invalid' : '' }}" type="text" name="thidhi" id="thidhi" value="{{ old('thidhi', $day->thidhi) }}" required>
                @if($errors->has('thidhi'))
                    <span class="text-danger">{{ $errors->first('thidhi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.thidhi_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nakshatram">{{ trans('cruds.day.fields.nakshatram') }}</label>
                <input class="form-control {{ $errors->has('nakshatram') ? 'is-invalid' : '' }}" type="text" name="nakshatram" id="nakshatram" value="{{ old('nakshatram', $day->nakshatram) }}" required>
                @if($errors->has('nakshatram'))
                    <span class="text-danger">{{ $errors->first('nakshatram') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.nakshatram_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rahukalam">{{ trans('cruds.day.fields.rahukalam') }}</label>
                <input class="form-control {{ $errors->has('rahukalam') ? 'is-invalid' : '' }}" type="text" name="rahukalam" id="rahukalam" value="{{ old('rahukalam', $day->rahukalam) }}" required>
                @if($errors->has('rahukalam'))
                    <span class="text-danger">{{ $errors->first('rahukalam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.rahukalam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="yamagandam">{{ trans('cruds.day.fields.yamagandam') }}</label>
                <input class="form-control {{ $errors->has('yamagandam') ? 'is-invalid' : '' }}" type="text" name="yamagandam" id="yamagandam" value="{{ old('yamagandam', $day->yamagandam) }}" required>
                @if($errors->has('yamagandam'))
                    <span class="text-danger">{{ $errors->first('yamagandam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.yamagandam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="durmuhurtham">{{ trans('cruds.day.fields.durmuhurtham') }}</label>
                <input class="form-control {{ $errors->has('durmuhurtham') ? 'is-invalid' : '' }}" type="text" name="durmuhurtham" id="durmuhurtham" value="{{ old('durmuhurtham', $day->durmuhurtham) }}" required>
                @if($errors->has('durmuhurtham'))
                    <span class="text-danger">{{ $errors->first('durmuhurtham') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.durmuhurtham_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="varjyamu">{{ trans('cruds.day.fields.varjyamu') }}</label>
                <input class="form-control {{ $errors->has('varjyamu') ? 'is-invalid' : '' }}" type="text" name="varjyamu" id="varjyamu" value="{{ old('varjyamu', $day->varjyamu) }}" required>
                @if($errors->has('varjyamu'))
                    <span class="text-danger">{{ $errors->first('varjyamu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.day.fields.varjyamu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heading">{{ trans('Heading') }}</label>
                <input class="form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}" type="text" name="heading" id="heading" value="{{ old('heading', $day->heading) }}">
                @if($errors->has('heading'))
                    <span class="text-danger">{{ $errors->first('heading') }}</span>
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
