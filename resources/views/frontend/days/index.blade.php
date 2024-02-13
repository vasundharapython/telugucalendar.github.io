@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('day_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.days.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Day">
                            <thead>
                                <tr>
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
                                        {{ trans('cruds.day.fields.shubasamayamulu') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.day.fields.amruthagadiyalu') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.day.fields.sygerionmuhurthalu') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.day.fields.thidhi') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.day.fields.nakshatram') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.day.fields.yogam') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.day.fields.karanam') }}
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
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($days as $key => $day)
                                    <tr data-entry-id="{{ $day->id }}">
                                        <td>
                                            {{ $day->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->suryodayam ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->suryastamam ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->shubasamayamulu ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->amruthagadiyalu ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->sygerionmuhurthalu ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->thidhi ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->nakshatram ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->yogam ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->karanam ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->rahukalam ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->yamagandam ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->durmuhurtham ?? '' }}
                                        </td>
                                        <td>
                                            {{ $day->varjyamu ?? '' }}
                                        </td>
                                        <td>
                                            @can('day_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.days.show', $day->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('day_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.days.edit', $day->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('day_delete')
                                                <form action="{{ route('frontend.days.destroy', $day->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('day_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.days.massDestroy') }}",
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
  let table = $('.datatable-Day:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection