@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('Annadanam') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.annadanams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('Id') }}
                        </th>
                        <td>
                            {{ $annadanam->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Full Name') }}
                        </th>
                        <td>
                            {{ $annadanam->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Contact Details') }}
                        </th>
                        <td>
                            {{ $annadanam->contact_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Email') }}
                        </th>
                        <td>
                            {{ $annadanam->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.annadanams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
