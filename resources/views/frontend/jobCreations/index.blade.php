@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('job_creation_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.job-creations.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.jobCreation.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'JobCreation', 'route' => 'admin.job-creations.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.jobCreation.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-JobCreation">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.jobCreation.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.jobCreation.fields.job') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.jobCreation.fields.job_category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.jobCreation.fields.job_role') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.jobCreation.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.jobCreation.fields.job_description') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobCreations as $key => $jobCreation)
                                    <tr data-entry-id="{{ $jobCreation->id }}">
                                        <td>
                                            {{ $jobCreation->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $jobCreation->job ?? '' }}
                                        </td>
                                        <td>
                                            {{ $jobCreation->job_category->category ?? '' }}
                                        </td>
                                        <td>
                                            {{ $jobCreation->job_role->job_role ?? '' }}
                                        </td>
                                        <td>
                                            {{ $jobCreation->location ?? '' }}
                                        </td>
                                        <td>
                                            {{ $jobCreation->job_description ?? '' }}
                                        </td>
                                        <td>
                                            @can('job_creation_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.job-creations.show', $jobCreation->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('job_creation_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.job-creations.edit', $jobCreation->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('job_creation_delete')
                                                <form action="{{ route('frontend.job-creations.destroy', $jobCreation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('job_creation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.job-creations.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-JobCreation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection