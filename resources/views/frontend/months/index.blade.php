@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('month_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.months.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.month.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Month', 'route' => 'admin.months.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.month.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Month">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.month.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.month.fields.month') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.month.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.month.fields.pandugalu') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.month.fields.govtselavu') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.month.fields.upavasalu') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.month.fields.importantdays') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($months as $key => $month)
                                    <tr data-entry-id="{{ $month->id }}">
                                        <td>
                                            {{ $month->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $month->month ?? '' }}
                                        </td>
                                        <td>
                                            {{ $month->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $month->pandugalu ?? '' }}
                                        </td>
                                        <td>
                                            {{ $month->govtselavu ?? '' }}
                                        </td>
                                        <td>
                                            {{ $month->upavasalu ?? '' }}
                                        </td>
                                        <td>
                                            {{ $month->importantdays ?? '' }}
                                        </td>
                                        <td>
                                            @can('month_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.months.show', $month->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('month_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.months.edit', $month->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('month_delete')
                                                <form action="{{ route('frontend.months.destroy', $month->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('month_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.months.massDestroy') }}",
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
  let table = $('.datatable-Month:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection