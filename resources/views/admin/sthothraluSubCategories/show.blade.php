@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('SthothraluSubCategory') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sthothralu-sub-categories.index') }}">
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
                            {{ $sthothraluSubCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Sthothralu category') }}
                        </th>
                        <td>
                            {{ $sthothraluSubCategory->subcategory->category ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Title') }}
                        </th>
                        <td>
                            {{ $sthothraluSubCategory->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sthothralu-sub-categories.index') }}">
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
            <a class="nav-link" href="#category_sthotralus" role="tab" data-toggle="tab">
                {{ trans('cruds.sthotralu.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="category_sthotralus">
            @includeIf('admin.sthothraluSubCategories.relationships.categorySthotralus', ['sthotralus' => $sthothraluSubCategory->categorySthotralus])
        </div>
    </div>
</div>

@endsection
