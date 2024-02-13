@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.horoscopedetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.horoscopedetails.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.horoscopedetail.fields.id') }}
                        </th>
                        <td>
                            {{ $horoscopedetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.horoscopedetail.fields.full_name') }}
                        </th>
                        <td>
                            {{ $horoscopedetail->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.horoscopedetail.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $horoscopedetail->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.horoscopedetail.fields.time_of_birth') }}
                        </th>
                        <td>
                            {{ $horoscopedetail->time_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.horoscopedetail.fields.place_of_birth') }}
                        </th>
                        <td>
                            {{ $horoscopedetail->place_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.horoscopedetail.fields.problem_details') }}
                        </th>
                        <td>
                            {{ $horoscopedetail->problem_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.horoscopedetail.fields.contact_details') }}
                        </th>
                        <td>
                            {{ $horoscopedetail->contact_details }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.horoscopedetails.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
