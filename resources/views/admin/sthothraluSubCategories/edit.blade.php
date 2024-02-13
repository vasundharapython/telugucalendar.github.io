@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('SthothraluSubCategory') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sthothralu-sub-categories.update", [$sthothraluSubCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="subcategory_id">{{ trans('Sthothralu Category') }}</label>
                <select class="form-control select2 {{ $errors->has('subcategory') ? 'is-invalid' : '' }}" name="subcategory_id" id="subcategory_id" required>
                    @foreach($subcategories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('subcategory_id') ? old('subcategory_id') : $sthothraluSubCategory->subcategory->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('subcategory'))
                    <span class="text-danger">{{ $errors->first('subcategory') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('Title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $sthothraluSubCategory->title) }}" required>
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
