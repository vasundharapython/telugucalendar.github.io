@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('Anubandham SubCategory') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ssub-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="scategory_id">{{ trans('Anubandham Category') }}</label>
                <select class="form-control select2 {{ $errors->has('scategory') ? 'is-invalid' : '' }}" name="scategory_id" id="scategory_id" required>
                    @foreach($scategories as $id => $entry)
                        <option value="{{ $id }}" {{ old('scategory_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('scategory'))
                    <span class="text-danger">{{ $errors->first('scategory') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('Title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
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
