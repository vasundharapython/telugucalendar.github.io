@extends('layouts.admin')
@section('content')
@can('day_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('gallery.create') }}">
                {{ trans('global.add') }} {{ trans('Image') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('Gallery') }}
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
                @foreach ($gallery as $key => $g)
                <tr>
                    <td>{{++$key}}</td>
                    <td><img src = "{{asset('storage/'.$g->image)}}"></td>
                    <td>
                        <a onclick = "return confirm('Are sure you want delete?')" href = "{{url('gallery/'.$g->id.'/delete')}}"class = "btn btn-danger btn-sm"><i class = "fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
