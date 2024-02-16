@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.month.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.months.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.month.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $month->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.month.fields.month') }}
                                    </th>
                                    <td>
                                        {{ $month->month }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.month.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $month->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.month.fields.pandugalu') }}
                                    </th>
                                    <td>
                                        {{ $month->pandugalu }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.month.fields.govtselavu') }}
                                    </th>
                                    <td>
                                        {{ $month->govtselavu }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.month.fields.upavasalu') }}
                                    </th>
                                    <td>
                                        {{ $month->upavasalu }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.month.fields.importantdays') }}
                                    </th>
                                    <td>
                                        {{ $month->importantdays }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.months.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection