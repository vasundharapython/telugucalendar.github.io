@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('Anubandham') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sthothralu-copies.index') }}">
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
                            {{ $sthothraluCopy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Anubandham SubCategory') }}
                        </th>
                        <td>
                            {{ $sthothraluCopy->ssubcategory->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Title') }}
                        </th>
                        <td>
                            {{ $sthothraluCopy->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Description') }}
                        </th>
                        <td>
                            {!! $sthothraluCopy->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Image') }}
                        </th>
                        <td>
                            @if($sthothraluCopy->image)
                                <a href="{{ $sthothraluCopy->image->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sthothralu-copies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
