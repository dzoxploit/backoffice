@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{ $pageTitle }}</h4>
        </div>
        <div>
            <a href="{{ url('/cetak-surat-jalan-tagihan-b2c/'.$data_invoice->trans_id) }}"><button class="btn btn-primary">Print To PDF</button></a>
        </div>
    </div>
    <div class="iq-card-body">
        <div class="row">
            <div class="col-8">
                <table>
                    <tr>
                        <td>ID Invoice</td>
                        <td class="pl-4">
                            :
                            <span><span>{{ $data_invoice->trans_invoice }}</span></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Bill To</td>
                        <td class="pl-4"> :
                        {{ $data_invoice->trans_name }}
                        </td>
                    </tr>
                    <tr>
                        <td>Ship To</td>
                        <td class="pl-4"> :
                        {{ $data_invoice->trans_address}}, {{$data_invoice->kab_nama}} , {{ $data_invoice->propinsi_nama }} , {{ $data_invoice->trans_zipcode }}
                        </td>
                    </tr>

                    </tr>

                </table>
            </div>
            <div class="col-4">
                <table>
                    <tr>
                        <td>Ship Via</td>
                        <td class="pl-4">
                            :
                            ({{ $data_invoice->trans_carrier_pc }}) {{$data_invoice->trans_carrier_name}}
                        </td>
                    </tr>
                    <tr>
                        <td>Currency</td>
                        <td class="pl-4">
                            :
                            <span>IDR</span>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
            aria-describedby="user-list-page-info">
            <thead>
                <tr>
                    <th>Sku</th>
                    <th>Nama Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Weight</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detail_invoice as $dinv)
                    <tr>
                        <td>{{ $dinv->prod_sku }}</td>
                        <td>{{ $dinv->prod_name }}</td>
                        <td>{{ $dinv->detail_quantity }}</td>
                        <td>{{ "Rp " . number_format($dinv->unit_price,2,',','.') }}
                        </td>
                        <td>{{ $dinv->weight }}</td>
                        <td>{{ "Rp " . number_format($dinv->ammount,2,',','.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix py-3">
            <div class="card float-right total-info mt-3">
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="text-right pl-5">Sub Total : </td>
                            <td class="text-right pl-5">{{ $data_invoice->trans_subtotal }}</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Freight : </td>
                            <td class="text-right pl-5">{{ $data_invoice->trans_carrier_price }}</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Total Harga : </td>
                            <td class="text-right pl-5">{{ $data_invoice->trans_payment_value }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="float-left total-info mt-3">
                <div class="card">
                    <div class="card-body">
                        <label for="inputNote">Note :</label>
                        <textarea class="form-control" name="inputSalesInvoiceNote" form="salesInvoiceFormSave"
                            id="inputSalesInvoiceCreateNote" placeholder="Masukan Note" rows="2"
                            cols="75" readonly>{{ $data_invoice->trans_note ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card float-right total-info mt-3 w-50">

            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Detail PO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('purchase/order/product/') }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="discount">Qty</label>
                            <input type="number" class="form-control" name="qty" id="editdetailqty" value="1">
                        </div>
                        <div class="col-6">
                            <label for="discount">Discount</label>
                            <input type="number" class="form-control" name="discount" id="editdetaildiscount" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="discount-type">Discount Type</label>
                            <select class="form-control" name="type" id="discount-type">
                                <option value="0">Discount Type</option>
                                <option value="%"
                                    {{ !empty($tempPo->type) == '%' ? 'selected' : '' }}>
                                    %</option>
                                <option value="$"
                                    {{ !empty($tempPo->type) == '$' ? 'selected' : '' }}>
                                    $</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
