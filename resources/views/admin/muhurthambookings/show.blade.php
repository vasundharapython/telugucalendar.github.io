@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.muhurthambooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.muhurthambookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.muhurthambooking.fields.id') }}
                        </th>
                        <td>
                            {{ $muhurthambooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.muhurthambooking.fields.full_name') }}
                        </th>
                        <td>
                            {{ $muhurthambooking->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.muhurthambooking.fields.spouse_name') }}
                        </th>
                        <td>
                            {{ $muhurthambooking->spouse_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.muhurthambooking.fields.stars') }}
                        </th>
                        <td>
                            {{ $muhurthambooking->stars }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.muhurthambooking.fields.seeking_muhurtham') }}
                        </th>
                        <td>
                            {{ $muhurthambooking->seeking_muhurtham }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.muhurthambooking.fields.place_of_muhurtham') }}
                        </th>
                        <td>
                            {{ $muhurthambooking->place_of_muhurtham }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.muhurthambooking.fields.contact_details') }}
                        </th>
                        <td>
                            {{ $muhurthambooking->contact_details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.muhurthambookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
