@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('Vedasukthulu SubCategory') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vedasukthulu-sub-categories.index') }}">
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
                            {{ $vedasukthuluSubCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Vedasukthulu Category') }}
                        </th>
                        <td>
                            {{ $vedasukthuluSubCategory->category->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('Title') }}
                        </th>
                        <td>
                            {{ $vedasukthuluSubCategory->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vedasukthulu-sub-categories.index') }}">
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
            <a class="nav-link" href="#subcategory_vedasukthulus" role="tab" data-toggle="tab">
                {{ trans('cruds.vedasukthulu.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="subcategory_vedasukthulus">
            @includeIf('admin.vedasukthuluSubCategories.relationships.subcategoryVedasukthulus', ['vedasukthulus' => $vedasukthuluSubCategory->subcategoryVedasukthulus])
        </div>
    </div>
</div>

@endsection
