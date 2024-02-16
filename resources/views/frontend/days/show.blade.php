@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.day.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.days.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $day->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $day->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.suryodayam') }}
                                    </th>
                                    <td>
                                        {{ $day->suryodayam }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.suryastamam') }}
                                    </th>
                                    <td>
                                        {{ $day->suryastamam }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.shubasamayamulu') }}
                                    </th>
                                    <td>
                                        {{ $day->shubasamayamulu }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.amruthagadiyalu') }}
                                    </th>
                                    <td>
                                        {{ $day->amruthagadiyalu }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.sygerionmuhurthalu') }}
                                    </th>
                                    <td>
                                        {{ $day->sygerionmuhurthalu }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.thidhi') }}
                                    </th>
                                    <td>
                                        {{ $day->thidhi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.nakshatram') }}
                                    </th>
                                    <td>
                                        {{ $day->nakshatram }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.yogam') }}
                                    </th>
                                    <td>
                                        {{ $day->yogam }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.karanam') }}
                                    </th>
                                    <td>
                                        {{ $day->karanam }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.rahukalam') }}
                                    </th>
                                    <td>
                                        {{ $day->rahukalam }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.yamagandam') }}
                                    </th>
                                    <td>
                                        {{ $day->yamagandam }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.durmuhurtham') }}
                                    </th>
                                    <td>
                                        {{ $day->durmuhurtham }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.day.fields.varjyamu') }}
                                    </th>
                                    <td>
                                        {{ $day->varjyamu }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.days.index') }}">
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