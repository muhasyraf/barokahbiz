@can('sales_report_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sales-reports.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.salesReport.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.salesReport.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-statusSalesReports">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.salesReport.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.salesReport.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.salesReport.fields.tgl_sales_order') }}
                        </th>
                        <th>
                            {{ trans('cruds.salesReport.fields.no_sales_order') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesReports as $key => $salesReport)
                        <tr data-entry-id="{{ $salesReport->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $salesReport->id ?? '' }}
                            </td>
                            <td>
                                {{ $salesReport->status->status ?? '' }}
                            </td>
                            <td>
                                {{ $salesReport->tgl_sales_order->tanggal ?? '' }}
                            </td>
                            <td>
                                {{ $salesReport->no_sales_order->no_sales_order ?? '' }}
                            </td>
                            <td>
                                @can('sales_report_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sales-reports.show', $salesReport->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sales_report_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sales-reports.edit', $salesReport->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sales_report_delete')
                                    <form action="{{ route('admin.sales-reports.destroy', $salesReport->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('sales_report_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sales-reports.massDestroy') }}",
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
  let table = $('.datatable-statusSalesReports:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection