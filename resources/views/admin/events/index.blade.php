@extends('layouts.admin')
@section('content')
@can('day_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('event.create') }}">
                {{ trans('global.add') }} {{ trans('Month MIS') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.model', ['model' => 'Event', 'route' => 'event.import'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('Month MIS') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Day">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.day.fields.id') }}
                    </th>
                    <th>
                        {{ trans('Title') }}
                    </th>
                    <th>
                        {{ trans('Date') }}
                    </th>
                    <th>
                        {{ trans('imgae') }}
                    </th>
                    <th>
                        {{ trans('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($event as $key => $ev)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$ev->title}}</td>
                    <td>{{$ev->start_date}}</td>
                    <td>
                        <img src = "{{asset('storage/'.$ev->image)}}" style = "width:100px; height:100px">
                    </td>
                    <td>
                        <a href = "{{url('event/'.$ev->id. '/edit')}}"class = "btn btn-primary btn-sm"><i class = "fa fa-edit"></i></a>
                        <a onclick = "return confirm('Are sure you want delete?')" href = "{{url('event/'.$ev->id.'/delete')}}"class = "btn btn-danger btn-sm"><i class = "fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "",
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
    ajax: "{{ route('event.index') }}",
//     columns: [
//       { data: 'placeholder', name: 'placeholder' },
// { data: 'id', name: 'id' },
// { data: 'month', name: 'month' },
// { data: 'date', name: 'date' },
// { data: 'description', name: 'description' },
// { data: 'actions', name: '{{ trans('global.actions') }}' }
//     ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Event').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection
