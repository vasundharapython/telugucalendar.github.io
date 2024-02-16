@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.month.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.months.update", [$month->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="month_id">{{ trans('cruds.month.fields.month') }}</label>
                <select class="form-control select2 {{ $errors->has('month') ? 'is-invalid' : '' }}" name="month_id" id="month_id" required>
                    @foreach($months as $id => $entry)
                        <option value="{{ $entry }}" {{ (old('month_id') ? old('month_id') : $month->month->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('month'))
                    <span class="text-danger">{{ $errors->first('month') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.month.fields.month_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.month.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $month->date) }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.month.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pandugalu">{{ trans('Heading') }}</label>
                <input class="form-control {{ $errors->has('heading') ? 'is-invalid' : '' }}" type="text" name="heading" id="heading" value="{{ old('heading', $month->heading) }}">
                @if($errors->has('heading'))
                    <span class="text-danger">{{ $errors->first('heading') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="pandugalu">{{ trans('cruds.month.fields.pandugalu') }}</label>
                <input class="form-control {{ $errors->has('pandugalu') ? 'is-invalid' : '' }}" type="text" name="pandugalu" id="pandugalu" value="{{ old('pandugalu', $month->pandugalu) }}">
                @if($errors->has('pandugalu'))
                    <span class="text-danger">{{ $errors->first('pandugalu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.month.fields.pandugalu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="govtselavu">{{ trans('cruds.month.fields.govtselavu') }}</label>
                <input class="form-control {{ $errors->has('govtselavu') ? 'is-invalid' : '' }}" type="text" name="govtselavu" id="govtselavu" value="{{ old('govtselavu', $month->govtselavu) }}">
                @if($errors->has('govtselavu'))
                    <span class="text-danger">{{ $errors->first('govtselavu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.month.fields.govtselavu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="upavasalu">{{ trans('cruds.month.fields.upavasalu') }}</label>
                <input class="form-control {{ $errors->has('upavasalu') ? 'is-invalid' : '' }}" type="text" name="upavasalu" id="upavasalu" value="{{ old('upavasalu', $month->upavasalu) }}">
                @if($errors->has('upavasalu'))
                    <span class="text-danger">{{ $errors->first('upavasalu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.month.fields.upavasalu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="importantdays">{{ trans('cruds.month.fields.importantdays') }}</label>
                <input class="form-control {{ $errors->has('importantdays') ? 'is-invalid' : '' }}" type="text" name="importantdays" id="importantdays" value="{{ old('importantdays', $month->importantdays) }}">
                @if($errors->has('importantdays'))
                    <span class="text-danger">{{ $errors->first('importantdays') }}</span>
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



@endsection
