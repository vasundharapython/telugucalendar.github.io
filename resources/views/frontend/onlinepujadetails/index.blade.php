@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('onlinepujadetail_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.onlinepujadetails.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.onlinepujadetail.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Onlinepujadetail', 'route' => 'admin.onlinepujadetails.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.onlinepujadetail.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Onlinepujadetail">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.onlinepujadetail.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.onlinepujadetail.fields.full_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.onlinepujadetail.fields.details_of_program') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.onlinepujadetail.fields.place_of_program') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.onlinepujadetail.fields.date_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.onlinepujadetail.fields.contact_details') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($onlinepujadetails as $key => $onlinepujadetail)
                                    <tr data-entry-id="{{ $onlinepujadetail->id }}">
                                        <td>
                                            {{ $onlinepujadetail->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $onlinepujadetail->full_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $onlinepujadetail->details_of_program ?? '' }}
                                        </td>
                                        <td>
                                            {{ $onlinepujadetail->place_of_program ?? '' }}
                                        </td>
                                        <td>
                                            {{ $onlinepujadetail->date_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $onlinepujadetail->contact_details ?? '' }}
                                        </td>
                                        <td>


                                            @can('onlinepujadetail_delete')
                                                <form action="{{ route('frontend.onlinepujadetails.destroy', $onlinepujadetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('onlinepujadetail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.onlinepujadetails.massDestroy') }}",
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
  let table = $('.datatable-Onlinepujadetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection