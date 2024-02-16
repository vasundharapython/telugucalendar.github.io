@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bhakthigeetam.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bhakthigeetams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bhakthigeetam.fields.id') }}
                        </th>
                        <td>
                            {{ $bhakthigeetam->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Bhakthigeetam Category') }}
                        </th>
                        <td>
                            {{ $bhakthigeetam->category->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bhakthigeetam.fields.title') }}
                        </th>
                        <td>
                            {{ $bhakthigeetam->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bhakthigeetam.fields.description') }}
                        </th>
                        <td>
                            {!! $bhakthigeetam->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bhakthigeetam.fields.image') }}
                        </th>
                        <td>
                            @if($bhakthigeetam->image)
                                <a href="{{ $bhakthigeetam->image->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bhakthigeetams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection