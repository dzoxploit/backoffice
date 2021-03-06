@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{ $pageTitle }}</h4>
        </div>
        <div>
            <form action="{{ url('/sales/purchaseorders/'.$po->po_id ?? '') }}" class="d-inline-block"
                method="POST">
                @method('delete')
                @csrf
                <button type="submit" data-toggle="tooltip" data-placement="top" id="save-purchase-order"
                    class="btn btn-danger">Delete</button>
            </form>    
        </div>
    </div>
    <div class="iq-card-body">
        <div class="row no-gutters mb-4">
            <div class="col-8">
                <table>
                    <tr>
                        <td class="pr-4">DM PO ID (internal)</td>
                        <td>: {{ str_pad($po->po_id, 4, '0', STR_PAD_LEFT).$po->po_id_format ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>No. Customer PO </td>
                        <td>: {{ $po->po_num ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Customer</td>
                        <td>: {{ $po->customer_name ?? '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-4 clearfix">
                <table class="float-right">
                    <tr class="text-right">
                        <td class="pr-4">Tgl. PO :</td>
                        <td>{{ !empty($po) ? date('Y-m-d', strtotime($po->po_date)) : '' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    
        <div class="row">
            <div class="col">
                <label for="inputNote">Note :</label>
                <textarea class="form-control" name="do-note" id="inputDeliveryDoNote" disabled readonly
                    rows="2">{{ $po->po_note ?? '' }}</textarea>
            </div>
        </div>
        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
            aria-describedby="user-list-page-info">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Nama Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailPo as $dpo)
                    <tr>
                        <td>{{ $dpo->product_id }}</td>
                        <td>{{ $dpo->product_name }}</td>
                        <td>{{ $dpo->qty }}</td>
                        <td>{{ "Rp " . number_format($dpo->unit_price,2,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix py-3">
            <div class="card float-left total-info">
                <div class="card-body">
                    <h5 class="card-title"><b>Po Image</b></h5>
                    <img src="{{ url('/storage/'.$po->po_attachment) }}" alt="" style="width: 300px">
                </div>
            </div>
            <div class="card float-right total-info"> 
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="">Sub Total </td>
                            <td class="text-left pl-5" id="purchaseOrderSubTotalHarga">: {{ "Rp " . number_format($subTotal,2,',','.') }}</td>
                        </tr>
                        <tr>
                            @php
                            if ($po->po_discount_type == '%') {
                                $poDiscount = $subTotal * $po->po_discount/100;
                            }elseif ($po->po_discount_type == '$') {
                                $poDiscount = $subTotal - $po->discount;
                            }
                            @endphp
                            <td class="">Discount</td>
                            <td class="text-left pl-5">
                               : {{ "Rp " . number_format($poDiscount,2,',','.') }}
                            </td>
                        </tr>
                        <tr class="font-weight-bold h4">
                            @php
                            if ($po->po_discount_type == '%') {
                                $discount = $subTotal * $po->po_discount/100;
                                $totalHarga = $subTotal - $discount;
                            }elseif ($po->po_discount_type == '$') {
                                $totalHarga = $subTotal - $po->discount;
                            }
                            @endphp
                            
                            <td style="padding: 1rem 0">Total </td>
                            <td class="text-left pl-5" style="padding: 1rem 0" id="purchaseOrderTotalHarga">: {{ "Rp " . number_format($totalHarga,2,',','.') }}</td>
                        </tr>
                    </table>

                </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Detail Delivery Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/deliveryorders/detail') }}" method="POST">
                @csrf
                @method('patch')
                <input type="text" name="prod-id" id="deliveryEditProductId" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="discount">Qty</label>
                            <input type="number" class="form-control" name="qty" id="deliveryEditQty" value="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputNote">Note :</label>
                            <textarea class="form-control" name="note" id="deliveryEditNote" rows="2"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
