@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('Vedasukthulu') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vedasukthulus.index') }}">
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
                            {{ $vedasukthulu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Vedasukthulu Subcategory') }}
                        </th>
                        <td>
                            {{ $vedasukthulu->subcategory->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Title') }}
                        </th>
                        <td>
                            {{ $vedasukthulu->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Description') }}
                        </th>
                        <td>
                            {!! $vedasukthulu->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Image') }}
                        </th>
                        <td>
                            @if($vedasukthulu->image)
                                <a href="{{ $vedasukthulu->image->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vedasukthulus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
