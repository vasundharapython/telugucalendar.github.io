@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('month_mi_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.month-mis.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.monthMi.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'MonthMi', 'route' => 'admin.month-mis.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.monthMi.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-MonthMi">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.monthMi.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.monthMi.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.monthMi.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.monthMi.fields.end_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.monthMi.fields.image') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monthMis as $key => $monthMi)
                                    <tr data-entry-id="{{ $monthMi->id }}">
                                        <td>
                                            {{ $monthMi->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $monthMi->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $monthMi->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $monthMi->end_date ?? '' }}
                                        </td>
                                        <td>
                                            @if($monthMi->image)
                                                <a href="{{ $monthMi->image->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('month_mi_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.month-mis.show', $monthMi->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('month_mi_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.month-mis.edit', $monthMi->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('month_mi_delete')
                                                <form action="{{ route('frontend.month-mis.destroy', $monthMi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('month_mi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.month-mis.massDestroy') }}",
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
  let table = $('.datatable-MonthMi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection