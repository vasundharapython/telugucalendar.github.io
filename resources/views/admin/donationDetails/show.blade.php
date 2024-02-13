@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.donationDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donation-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.donationDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $donationDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donationDetail.fields.full_name') }}
                        </th>
                        <td>
                            {{ $donationDetail->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donationDetail.fields.contact_details') }}
                        </th>
                        <td>
                            {{ $donationDetail->contact_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donationDetail.fields.email') }}
                        </th>
                        <td>
                            {{ $donationDetail->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donation-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
