@extends('layouts.admin')
@section('content')
@can('horoscopedetail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.horoscopedetails.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.horoscopedetail.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Horoscopedetail', 'route' => 'admin.horoscopedetails.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.horoscopedetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Horoscopedetail">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.horoscopedetail.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.horoscopedetail.fields.full_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.horoscopedetail.fields.date_of_birth') }}
                    </th>
                    <th>
                        {{ trans('cruds.horoscopedetail.fields.time_of_birth') }}
                    </th>
                    <th>
                        {{ trans('cruds.horoscopedetail.fields.place_of_birth') }}
                    </th>
                    <th>
                        {{ trans('cruds.horoscopedetail.fields.problem_details') }}
                    </th>
                    <th>
                        {{ trans('cruds.horoscopedetail.fields.contact_details') }}
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
@can('horoscopedetail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.horoscopedetails.massDestroy') }}",
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
    ajax: "{{ route('admin.horoscopedetails.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'full_name', name: 'full_name' },
{ data: 'date_of_birth', name: 'date_of_birth' },
{ data: 'time_of_birth', name: 'time_of_birth' },
{ data: 'place_of_birth', name: 'place_of_birth' },
{ data: 'problem_details', name: 'problem_details' },
{ data: 'contact_details', name: 'contact_details' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Horoscopedetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
