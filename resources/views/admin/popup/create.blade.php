@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.popup.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="image">{{ trans('Image') }}</label>
                <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="file" name="image" id="image" value="{{ old('image', '') }}" required>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
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
