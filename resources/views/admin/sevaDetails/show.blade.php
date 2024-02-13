@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sevaDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seva-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sevaDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $sevaDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sevaDetail.fields.full_name') }}
                        </th>
                        <td>
                            {{ $sevaDetail->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sevaDetail.fields.email') }}
                        </th>
                        <td>
                            {{ $sevaDetail->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sevaDetail.fields.contact_details') }}
                        </th>
                        <td>
                            {{ $sevaDetail->contact_details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.seva-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
