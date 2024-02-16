@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pujaBooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.puja-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pujaBooking.fields.id') }}
                        </th>
                        <td>
                            {{ $pujaBooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujaBooking.fields.name') }}
                        </th>
                        <td>
                            {{ $pujaBooking->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Date') }}
                        </th>
                        <td>
                            {{ $pujaBooking->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujaBooking.fields.gotram') }}
                        </th>
                        <td>
                            {{ $pujaBooking->gotram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujaBooking.fields.phone_no') }}
                        </th>
                        <td>
                            {{ $pujaBooking->phone_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujaBooking.fields.email') }}
                        </th>
                        <td>
                            {{ $pujaBooking->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujaBooking.fields.address') }}
                        </th>
                        <td>
                            {{ $pujaBooking->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pujaBooking.fields.requirement_of_puja') }}
                        </th>
                        <td>
                            {{ $pujaBooking->requirement_of_puja }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.puja-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
