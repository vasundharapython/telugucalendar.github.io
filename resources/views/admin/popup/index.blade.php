@extends('layouts.admin')
@section('content')
@can('day_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.popup.create') }}">
                {{ trans('global.add') }} {{ trans('Image') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('PopUp Image') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Day">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.day.fields.id') }}
                    </th>
                    <th>
                        {{ trans('Image') }}
                    </th>
                    <th>
                        {{ trans('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($popup as $key => $pu)
                <tr>
                    <td>{{++$key}}</td>
                    <td><img src = "{{asset('storage/'.$pu->image)}}"></td>
                    <td>
                        <a onclick = "return confirm('Are sure you want delete?')" href = "{{url('popup/'.$pu->id.'/delete')}}"class = "btn btn-danger btn-sm"><i class = "fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
