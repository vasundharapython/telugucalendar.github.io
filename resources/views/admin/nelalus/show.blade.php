@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('Nelalu') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nelalus.index') }}">
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
                            {{ $nelalu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Month') }}
                        </th>
                        <td>
                            {{ $nelalu->month }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.nelalus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#month_muhurthalus" role="tab" data-toggle="tab">
                {{ trans('cruds.muhurthalu.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#month_months" role="tab" data-toggle="tab">
                {{ trans('cruds.month.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="month_muhurthalus">
            @includeIf('admin.nelalus.relationships.monthMuhurthalus', ['muhurthalus' => $nelalu->monthMuhurthalus])
        </div>
        <div class="tab-pane" role="tabpanel" id="month_months">
            @includeIf('admin.nelalus.relationships.monthMonths', ['months' => $nelalu->monthMonths])
        </div>
    </div>
</div>

@endsection
