@extends('layouts.admin')
@section('content')
@can('puja_booking_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.puja-bookings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pujaBooking.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'PujaBooking', 'route' => 'admin.puja-bookings.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pujaBooking.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PujaBooking">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.pujaBooking.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.pujaBooking.fields.name') }}
                    </th>
                    <th>
                        {{ trans('Date') }}
                    </th>
                    <th>
                        {{ trans('cruds.pujaBooking.fields.gotram') }}
                    </th>
                    <th>
                        {{ trans('cruds.pujaBooking.fields.phone_no') }}
                    </th>
                    <th>
                        {{ trans('cruds.pujaBooking.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.pujaBooking.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.pujaBooking.fields.requirement_of_puja') }}
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
@can('puja_booking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.puja-bookings.massDestroy') }}",
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
    ajax: "{{ route('admin.puja-bookings.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'date', name: 'date' },
{ data: 'gotram', name: 'gotram' },
{ data: 'phone_no', name: 'phone_no' },
{ data: 'email', name: 'email' },
{ data: 'address', name: 'address' },
{ data: 'requirement_of_puja', name: 'requirement_of_puja' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-PujaBooking').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
