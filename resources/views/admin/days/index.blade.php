@extends('layouts.admin')
@section('content')
@can('day_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.days.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.day.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Day', 'route' => 'admin.days.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.day.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Day">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.day.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.suryodayam') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.suryastamam') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.thidhi') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.nakshatram') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.rahukalam') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.yamagandam') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.durmuhurtham') }}
                    </th>
                    <th>
                        {{ trans('cruds.day.fields.varjyamu') }}
                    </th>
                    <th>
                        {{ trans('Heading') }}
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
@can('day_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.days.massDestroy') }}",
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
    ajax: "{{ route('admin.days.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'date', name: 'date' },
{ data: 'suryodayam', name: 'suryodayam' },
{ data: 'suryastamam', name: 'suryastamam' },
{ data: 'thidhi', name: 'thidhi' },
{ data: 'nakshatram', name: 'nakshatram' },
{ data: 'rahukalam', name: 'rahukalam' },
{ data: 'yamagandam', name: 'yamagandam' },
{ data: 'durmuhurtham', name: 'durmuhurtham' },
{ data: 'varjyamu', name: 'varjyamu' },
{ data: 'heading', name: 'heading' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Day').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
