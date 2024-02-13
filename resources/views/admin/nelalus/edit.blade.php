@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('Nelalu') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.nelalus.update", [$nelalu->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="month">{{ trans('Month') }}</label>
                <input class="form-control {{ $errors->has('month') ? 'is-invalid' : '' }}" type="text" name="month" id="month" value="{{ old('month', $nelalu->month) }}" required>
                @if($errors->has('month'))
                    <span class="text-danger">{{ $errors->first('month') }}</span>
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
