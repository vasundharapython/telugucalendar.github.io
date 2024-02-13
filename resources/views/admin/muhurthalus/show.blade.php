@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('Muhurthalu') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.muhurthalus.index') }}">
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
                            {{ $muhurthalu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Month') }}
                        </th>
                        <td>
                            {{ $muhurthalu->month->month ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Date') }}
                        </th>
                        <td>
                            {{ $muhurthalu->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Muhurtham') }}
                        </th>
                        <td>
                            {{ $muhurthalu->muhurtham }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.muhurthalus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
