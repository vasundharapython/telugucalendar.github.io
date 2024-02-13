@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.godanamDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.godanam-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.godanamDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $godanamDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.godanamDetail.fields.full_name') }}
                        </th>
                        <td>
                            {{ $godanamDetail->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.godanamDetail.fields.contact_details') }}
                        </th>
                        <td>
                            {{ $godanamDetail->contact_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.godanamDetail.fields.email') }}
                        </th>
                        <td>
                            {{ $godanamDetail->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.godanam-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
