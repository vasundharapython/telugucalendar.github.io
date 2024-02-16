@extends('layouts.admin')
@section('content')
@can('annadanam_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.annadanams.create') }}">
                {{ trans('global.add') }} {{ trans('Annadanam') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Annadanam', 'route' => 'admin.annadanams.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('Annadanam') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Annadanam">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('Id') }}
                    </th>
                    <th>
                        {{ trans('Occasion') }}
                    </th>
                    <th>
                        {{ trans('Full Name') }}
                    </th>
                    <th>
                        {{ trans('Gotram') }}
                    </th>
                    <th>
                        {{ trans('Star') }}
                    </th>
                    <th>
                        {{ trans('Residence') }}
                    </th>
                    <th>
                        {{ trans('Contact Details') }}
                    </th>
                    <th>
                        {{ trans('Date') }}
                    </th>
                    <th>
                        {{ trans('Email') }}
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
@can('annadanam_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.annadanams.massDestroy') }}",
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
    ajax: "{{ route('admin.annadanams.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'occasion', name: 'occasion' },
{ data: 'full_name', name: 'full_name' },
{ data: 'gotram', name: 'gotram' },
{ data: 'star', name: 'star' },
{ data: 'residence', name: 'residence' },
{ data: 'contact_details', name: 'contact_details' },
{ data: 'date', name: 'date' },
{ data: 'email', name: 'email' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Annadanam').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
