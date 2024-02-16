@extends('layouts.admin')
@section('content')
@can('month_mi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.month-mis.create') }}">
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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MonthMi">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
                        {{ trans('cruds.monthMi.fields.rahukalam') }}
                    </th>
                    <th>
                        {{ trans('cruds.monthMi.fields.yamagandam') }}
                    </th>
                    <th>
                        {{ trans('cruds.monthMi.fields.durmuhurtham') }}
                    </th>
                    <th>
                        {{ trans('cruds.monthMi.fields.thidhi') }}
                    </th>
                    <th>
                        {{ trans('cruds.monthMi.fields.nakshatram') }}
                    </th>
                    <th>
                        {{ trans('cruds.monthMi.fields.varjyam') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('month_mi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.month-mis.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.month-mis.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'rahukalam', name: 'rahukalam' },
{ data: 'yamagandam', name: 'yamagandam' },
{ data: 'durmuhurtham', name: 'durmuhurtham' },
{ data: 'thidhi', name: 'thidhi' },
{ data: 'nakshatram', name: 'nakshatram' },
{ data: 'varjyam', name: 'varjyam' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-MonthMi').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
