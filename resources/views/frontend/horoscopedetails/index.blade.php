@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('horoscopedetail_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.horoscopedetails.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Horoscopedetail">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($horoscopedetails as $key => $horoscopedetail)
                                    <tr data-entry-id="{{ $horoscopedetail->id }}">
                                        <td>
                                            {{ $horoscopedetail->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $horoscopedetail->full_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $horoscopedetail->date_of_birth ?? '' }}
                                        </td>
                                        <td>
                                            {{ $horoscopedetail->time_of_birth ?? '' }}
                                        </td>
                                        <td>
                                            {{ $horoscopedetail->place_of_birth ?? '' }}
                                        </td>
                                        <td>
                                            {{ $horoscopedetail->problem_details ?? '' }}
                                        </td>
                                        <td>
                                            {{ $horoscopedetail->contact_details ?? '' }}
                                        </td>
                                        <td>


                                            @can('horoscopedetail_delete')
                                                <form action="{{ route('frontend.horoscopedetails.destroy', $horoscopedetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('horoscopedetail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.horoscopedetails.massDestroy') }}",
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
  let table = $('.datatable-Horoscopedetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection