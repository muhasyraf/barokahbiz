@extends('layouts.admin')
@section('content')
@can('jurnal_penyelesaian_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.jurnal-penyelesaians.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.jurnalPenyelesaian.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'JurnalPenyelesaian', 'route' => 'admin.jurnal-penyelesaians.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.jurnalPenyelesaian.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-JurnalPenyelesaian">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.jurnalPenyelesaian.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.jurnalPenyelesaian.fields.akun') }}
                    </th>
                    <th>
                        {{ trans('cruds.jurnalPenyelesaian.fields.keterangan') }}
                    </th>
                    <th>
                        {{ trans('cruds.jurnalPenyelesaian.fields.debit') }}
                    </th>
                    <th>
                        {{ trans('cruds.jurnalPenyelesaian.fields.kredit') }}
                    </th>
                    <th>
                        {{ trans('cruds.jurnalPenyelesaian.fields.total_debit') }}
                    </th>
                    <th>
                        {{ trans('cruds.jurnalPenyelesaian.fields.total_kredit') }}
                    </th>
                    <th>
                        {{ trans('cruds.jurnalPenyelesaian.fields.status') }}
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
@can('jurnal_penyelesaian_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.jurnal-penyelesaians.massDestroy') }}",
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
    ajax: "{{ route('admin.jurnal-penyelesaians.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'akun_account_name', name: 'akun.account_name' },
{ data: 'keterangan', name: 'keterangan' },
{ data: 'debit', name: 'debit' },
{ data: 'kredit', name: 'kredit' },
{ data: 'total_debit', name: 'total_debit' },
{ data: 'total_kredit', name: 'total_kredit' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-JurnalPenyelesaian').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection