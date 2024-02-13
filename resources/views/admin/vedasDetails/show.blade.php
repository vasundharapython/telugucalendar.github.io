@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vedasDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vedas-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vedasDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $vedasDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vedasDetail.fields.full_name') }}
                        </th>
                        <td>
                            {{ $vedasDetail->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vedasDetail.fields.email') }}
                        </th>
                        <td>
                            {{ $vedasDetail->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vedasDetail.fields.contact_details') }}
                        </th>
                        <td>
                            {{ $vedasDetail->contact_details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vedas-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
