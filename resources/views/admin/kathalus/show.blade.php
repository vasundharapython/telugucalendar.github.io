@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kathalu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kathalus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kathalu.fields.id') }}
                        </th>
                        <td>
                            {{ $kathalu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kathalu.fields.title') }}
                        </th>
                        <td>
                            {{ $kathalu->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kathalu.fields.description') }}
                        </th>
                        <td>
                            {!! $kathalu->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kathalu.fields.image') }}
                        </th>
                        <td>
                            @if($kathalu->image)
                                <a href="{{ $kathalu->image->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kathalus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
