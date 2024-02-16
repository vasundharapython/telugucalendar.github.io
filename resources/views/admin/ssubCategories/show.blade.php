@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('Anubandham SubCategory') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ssub-categories.index') }}">
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
                            {{ $ssubCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Anubandham Category') }}
                        </th>
                        <td>
                            {{ $ssubCategory->scategory->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Title') }}
                        </th>
                        <td>
                            {{ $ssubCategory->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ssub-categories.index') }}">
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
            <a class="nav-link" href="#ssubcategory_sthothralu_copies" role="tab" data-toggle="tab">
                {{ trans('cruds.sthothraluCopy.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ssubcategory_sthothralu_copies">
            @includeIf('admin.ssubCategories.relationships.ssubcategorySthothraluCopies', ['sthothraluCopies' => $ssubCategory->ssubcategorySthothraluCopies])
        </div>
    </div>
</div>

@endsection
