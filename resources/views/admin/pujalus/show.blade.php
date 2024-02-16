@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pujalu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pujalus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pujalu.fields.id') }}
                        </th>
                        <td>
                            {{ $pujalu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujalu.fields.title') }}
                        </th>
                        <td>
                            {{ $pujalu->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujalu.fields.description') }}
                        </th>
                        <td>
                            {{ $pujalu->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujalu.fields.image') }}
                        </th>
                        <td>
                            @if($pujalu->image)
                                <a href="{{ $pujalu->image->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pujalus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection