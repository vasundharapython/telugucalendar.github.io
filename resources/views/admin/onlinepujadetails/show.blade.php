@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.onlinepujadetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.onlinepujadetails.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.onlinepujadetail.fields.id') }}
                        </th>
                        <td>
                            {{ $onlinepujadetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.onlinepujadetail.fields.full_name') }}
                        </th>
                        <td>
                            {{ $onlinepujadetail->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.onlinepujadetail.fields.details_of_program') }}
                        </th>
                        <td>
                            {{ $onlinepujadetail->details_of_program }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.onlinepujadetail.fields.place_of_program') }}
                        </th>
                        <td>
                            {{ $onlinepujadetail->place_of_program }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.onlinepujadetail.fields.date_time') }}
                        </th>
                        <td>
                            {{ $onlinepujadetail->date_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.onlinepujadetail.fields.contact_details') }}
                        </th>
                        <td>
                            {{ $onlinepujadetail->contact_details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.onlinepujadetails.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
