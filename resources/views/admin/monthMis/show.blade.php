@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.monthMi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.month-mis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.id') }}
                        </th>
                        <td>
                            {{ $monthMi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.title') }}
                        </th>
                        <td>
                            {{ $monthMi->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.start_date') }}
                        </th>
                        <td>
                            {{ $monthMi->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.end_date') }}
                        </th>
                        <td>
                            {{ $monthMi->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.image') }}
                        </th>
                        <td>
                            @if($monthMi->image)
                                <a href="{{ $monthMi->image->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.rahukalam') }}
                        </th>
                        <td>
                            {{ $monthMi->rahukalam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.yamagandam') }}
                        </th>
                        <td>
                            {{ $monthMi->yamagandam }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.durmuhurtham') }}
                        </th>
                        <td>
                            {{ $monthMi->durmuhurtham }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.thidhi') }}
                        </th>
                        <td>
                            {{ $monthMi->thidhi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.nakshatram') }}
                        </th>
                        <td>
                            {{ $monthMi->nakshatram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monthMi.fields.varjyam') }}
                        </th>
                        <td>
                            {{ $monthMi->varjyam }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.month-mis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
