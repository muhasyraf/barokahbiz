@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.salesOrder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sales-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.salesOrder.fields.id') }}
                        </th>
                        <td>
                            {{ $salesOrder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesOrder.fields.no_sales_order') }}
                        </th>
                        <td>
                            {{ $salesOrder->no_sales_order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesOrder.fields.tanggal') }}
                        </th>
                        <td>
                            {{ $salesOrder->tanggal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesOrder.fields.sales_quotation') }}
                        </th>
                        <td>
                            {{ $salesOrder->sales_quotation->harga ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesOrder.fields.detail_order') }}
                        </th>
                        <td>
                            {{ $salesOrder->detail_order }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.salesOrder.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\SalesOrder::STATUS_SELECT[$salesOrder->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sales-orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#sales_order_customer_complains" role="tab" data-toggle="tab">
                {{ trans('cruds.customerComplain.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#status_sales_reports" role="tab" data-toggle="tab">
                {{ trans('cruds.salesReport.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tgl_sales_order_sales_reports" role="tab" data-toggle="tab">
                {{ trans('cruds.salesReport.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#sales_product_transaksi_keuangans" role="tab" data-toggle="tab">
                {{ trans('cruds.transaksiKeuangan.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="sales_order_customer_complains">
            @includeIf('admin.salesOrders.relationships.salesOrderCustomerComplains', ['customerComplains' => $salesOrder->salesOrderCustomerComplains])
        </div>
        <div class="tab-pane" role="tabpanel" id="status_sales_reports">
            @includeIf('admin.salesOrders.relationships.statusSalesReports', ['salesReports' => $salesOrder->statusSalesReports])
        </div>
        <div class="tab-pane" role="tabpanel" id="tgl_sales_order_sales_reports">
            @includeIf('admin.salesOrders.relationships.tglSalesOrderSalesReports', ['salesReports' => $salesOrder->tglSalesOrderSalesReports])
        </div>
        <div class="tab-pane" role="tabpanel" id="sales_product_transaksi_keuangans">
            @includeIf('admin.salesOrders.relationships.salesProductTransaksiKeuangans', ['transaksiKeuangans' => $salesOrder->salesProductTransaksiKeuangans])
        </div>
    </div>
</div>

@endsection