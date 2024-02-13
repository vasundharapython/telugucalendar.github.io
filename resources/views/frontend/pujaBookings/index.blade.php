@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('puja_booking_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.puja-bookings.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PujaBooking">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.pujaBooking.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.pujaBooking.fields.name') }}
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
                            <tbody>
                                @foreach($pujaBookings as $key => $pujaBooking)
                                    <tr data-entry-id="{{ $pujaBooking->id }}">
                                        <td>
                                            {{ $pujaBooking->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pujaBooking->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pujaBooking->gotram ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pujaBooking->phone_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pujaBooking->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pujaBooking->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $pujaBooking->requirement_of_puja ?? '' }}
                                        </td>
                                        <td>


                                            @can('puja_booking_delete')
                                                <form action="{{ route('frontend.puja-bookings.destroy', $pujaBooking->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('puja_booking_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.puja-bookings.massDestroy') }}",
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
  let table = $('.datatable-PujaBooking:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection