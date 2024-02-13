@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('Muhurthalu') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.muhurthalus.update", [$muhurthalu->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="month_id">{{ trans('Month') }}</label>
                <select class="form-control select2 {{ $errors->has('month') ? 'is-invalid' : '' }}" name="month_id" id="month_id" required>
                    @foreach($months as $id => $entry)
                        <option value="{{ $id }}" {{ (old('month_id') ? old('month_id') : $muhurthalu->month->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('month'))
                    <span class="text-danger">{{ $errors->first('month') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('Date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $muhurthalu->date) }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="muhurtham">{{ trans('Muhurtham') }}</label>
                <input class="form-control {{ $errors->has('muhurtham') ? 'is-invalid' : '' }}" type="text" name="muhurtham" id="muhurtham" value="{{ old('muhurtham', $muhurthalu->muhurtham) }}">
                @if($errors->has('muhurtham'))
                    <span class="text-danger">{{ $errors->first('muhurtham') }}</span>
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
