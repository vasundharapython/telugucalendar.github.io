@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('Sankatahari') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sankataharis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="month">{{ trans('Month') }}</label>
                <input class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}" type="text" name="month" id="month" value="{{ old('month', '') }}">
                @if($errors->has('month'))
                    <span class="text-danger">{{ $errors->first('month') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('Date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('Description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description" required>{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
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
