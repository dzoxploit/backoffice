@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{ $pageTitle }}</h4>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ url('/purchaseorders/print/pdf/'.$po->po_id) }}">Cetak</a>
            <form action="{{ url('/purchaseorders/'.$po->po_id ?? '') }}" class="d-inline-block"
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
                        <td class="pr-4">Purchase Order ID </td>
                        <td>: {{ $po->po_id_format.str_pad($po->po_id, 4, '0', STR_PAD_LEFT)}}</td>
                    </tr>
                    <tr>
                        <td>Supplier </td>
                        <td>: {{ $po->sup_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Alamat </td>
                        <td>: {{ $po->sup_address ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Email </td>
                        <td>: {{ $po->sup_email ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Syarat Pembayaran </td>
                        @if ($po->payment_term == 0)
                            <td>: Cash</td>
                        @elseif ($po->payment_term != null)
                            <td>: {{ $po->payment_term.'hr' ?? '' }}</td>
                        @endif
                    </tr>
                </table>
            </div>
            <div class="col-4 clearfix">
                <table class="float-right">
                    <tr class="text-right">
                        <td class="pr-4">Tgl. PO :</td>
                        <td>{{ !empty($po) ? date('Y-m-d', strtotime($po->date)) : '' }}</td>
                    </tr>
                    <tr class="text-right">
                        <td class="pr-4">Tanggal Penyerahan :</td>
                        <td>{{ !empty($po) ? date('Y-m-d', strtotime($po->delivery_date)) : '' }}</td>
                    </tr>
                    <tr class="text-right">
                        <td class="pr-4">Tempat Penyerahan :</td>
                        <td>{{ $po->delivery_point ?? '' }}</td>
                    </tr>
                    <tr class="text-right">
                        <td class="pr-4">Contact Person :</td>
                        <td>{{ $po->contact_person ?? '' }}</td>
                    </tr>
                    <tr class="text-right">
                        <td class="pr-4">Request :</td>
                        <td>{{ $po->po_request ?? '' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="inputNote">Note :</label>
                <textarea class="form-control" name="do-note" id="inputDeliveryDoNote" disabled readonly
                    rows="2">{{ $po->note ?? '' }}</textarea>
            </div>
        </div>
        </form>
        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
            aria-describedby="user-list-page-info">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product ID</th>
                    <th>Nama Product</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Unit Price</th>
                    <th>Ammount</th>
                    <th>Discount</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $detailPoNum = 1;    
                @endphp
                @foreach($detailPo as $dpo)
                    <tr>
                        <td>{{ $detailPoNum++ }}</td>
                        <td>{{ $dpo->product_id }}</td>
                        <td>{{ $dpo->product_name }}</td>
                        <td>{{ $dpo->qty }}</td>
                        <td>{{ $dpo->unit ?? '-' }}</td>
                        <td>{{ "Rp " . number_format($dpo->unit_price,2,',','.') }}</td>
                        <td>{{ "Rp " . number_format($dpo->unit_price * $dpo->qty,2,',','.') }}</td>
                        <td>{{ !empty($dpo->discount) ? $dpo->discount.'%' : 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix py-3">
            <div class="float-left total-info mt-3">
                <div class="card">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td>Pembuat</td>
                                <td>: {{ !empty($authority) ? $authority[0]->authorization_name : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Penyetuju</td>
                                <td>: {{ !empty($authority) ? $authority[1]->authorization_name  : '-'}}</td>
                            </tr>
                        </table>
                    </div>
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
                            <td>Discount</td>
                            @php
                            if ($po->type == '%') {
                                $poDiscount = $po->discount.$po->type;
                            }elseif ($po->type == '$') {
                                $poDiscount = "Rp " . number_format($po->discount,2,',','.');
                            }else {
                                $poDiscount = '-';
                            }
                            @endphp
                            <td class="text-left pl-5">
                                : {{ $poDiscount ?? '' }}
                            </td>
                            
                        </tr>
                        <tr>
                            <td>PPN</td>
                            <td class="text-left pl-5">
                                : {{ ($po->ppn != 0) ? $po->ppn.'%' : '-' }}
                            </td>
                        </tr>
                        <tr>
                            @php
                            if ($po->type == '%') {
                                $discount = $subTotal * $po->discount/100;
                                $totalHarga = $subTotal - $discount;
                            }elseif ($po->type == '$') {
                                $totalHarga = $subTotal - $po->discount;
                            }else {
                                $totalHarga = $subTotal;
                            }
                            @endphp
                            
                            <td class="h5" style="padding: 1rem 0">Total</td>
                            <td class="text-left pl-5 h5" style="padding: 1rem 0" id="purchaseOrderTotalHarga">: {{ "Rp " . number_format($totalHarga + $po->ppn,2,',','.') }}</td>
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
