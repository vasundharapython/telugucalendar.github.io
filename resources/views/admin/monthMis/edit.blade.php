@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.monthMi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.month-mis.update", [$monthMi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.monthMi.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $monthMi->title) }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.monthMi.fields.start_date') }}</label>
                <input class="form-control datetime {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $monthMi->start_date) }}">
                @if($errors->has('start_date'))
                    <span class="text-danger">{{ $errors->first('start_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.monthMi.fields.end_date') }}</label>
                <input class="form-control datetime {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $monthMi->end_date) }}">
                @if($errors->has('end_date'))
                    <span class="text-danger">{{ $errors->first('end_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.monthMi.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rahukalam">{{ trans('cruds.monthMi.fields.rahukalam') }}</label>
                <input class="form-control {{ $errors->has('rahukalam') ? 'is-invalid' : '' }}" type="text" name="rahukalam" id="rahukalam" value="{{ old('rahukalam', $monthMi->rahukalam) }}">
                @if($errors->has('rahukalam'))
                    <span class="text-danger">{{ $errors->first('rahukalam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.rahukalam_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="yamagandam">{{ trans('cruds.monthMi.fields.yamagandam') }}</label>
                <input class="form-control {{ $errors->has('yamagandam') ? 'is-invalid' : '' }}" type="text" name="yamagandam" id="yamagandam" value="{{ old('yamagandam', $monthMi->yamagandam) }}">
                @if($errors->has('yamagandam'))
                    <span class="text-danger">{{ $errors->first('yamagandam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.yamagandam_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="durmuhurtham">{{ trans('cruds.monthMi.fields.durmuhurtham') }}</label>
                <input class="form-control {{ $errors->has('durmuhurtham') ? 'is-invalid' : '' }}" type="text" name="durmuhurtham" id="durmuhurtham" value="{{ old('durmuhurtham', $monthMi->durmuhurtham) }}">
                @if($errors->has('durmuhurtham'))
                    <span class="text-danger">{{ $errors->first('durmuhurtham') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.durmuhurtham_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="thidhi">{{ trans('cruds.monthMi.fields.thidhi') }}</label>
                <input class="form-control {{ $errors->has('thidhi') ? 'is-invalid' : '' }}" type="text" name="thidhi" id="thidhi" value="{{ old('thidhi', $monthMi->thidhi) }}">
                @if($errors->has('thidhi'))
                    <span class="text-danger">{{ $errors->first('thidhi') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.thidhi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nakshatram">{{ trans('cruds.monthMi.fields.nakshatram') }}</label>
                <input class="form-control {{ $errors->has('nakshatram') ? 'is-invalid' : '' }}" type="text" name="nakshatram" id="nakshatram" value="{{ old('nakshatram', $monthMi->nakshatram) }}">
                @if($errors->has('nakshatram'))
                    <span class="text-danger">{{ $errors->first('nakshatram') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.nakshatram_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="varjyam">{{ trans('cruds.monthMi.fields.varjyam') }}</label>
                <input class="form-control {{ $errors->has('varjyam') ? 'is-invalid' : '' }}" type="text" name="varjyam" id="varjyam" value="{{ old('varjyam', $monthMi->varjyam) }}">
                @if($errors->has('varjyam'))
                    <span class="text-danger">{{ $errors->first('varjyam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.monthMi.fields.varjyam_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.month-mis.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($monthMi) && $monthMi->image)
      var file = {!! json_encode($monthMi->image) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
