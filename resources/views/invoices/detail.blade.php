@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{ $pageTitle }}</h4>
        </div>
        <div>
            <form action="{{ url()->current() }}" class="d-inline-block"
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
                        <td class="pr-4">Invoice ID</td>
                        <td>: {{ $invoice->invoice_id ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>No. Invoice (external)</td>
                        <td>: {{ $invoice->no_invoice ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Purchase Order ID</td>
                        <td>:   {{ str_pad($invoice->po_id, 4, '0', STR_PAD_LEFT).$invoice->po_id_format }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-4 clearfix">
                <table class="float-right">
                    <tr class="text-right">
                        <td class="pr-4">Batas Waktu :</td>
                        <td>{{ !empty($invoice) ? date('Y-m-d', strtotime($invoice->due_date)) : '' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="inputNote">Note :</label>
                <textarea class="form-control" name="do-note" id="inputDeliveryDoNote" disabled readonly
                    rows="2">{{ $invoice->note ?? '' }}</textarea>
            </div>
        </div>
        </form>
        <div class="clearfix py-3">
            <div class="card float-left total-info">
                <div class="card-body">
                    <h5 class="card-title"><b>Po Image</b></h5>
                    <img src="{{ url('/storage/'.$invoice->invoice_attachment) }}" alt="" style="width: 300px">
                </div>
            </div>
            <div class="card float-right total-info">
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="">PO Total </td>
                            <td class="text-left pl-5" id="invoiceTotal">: {{ "Rp. " . number_format($poTotal, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="">Pajak  </td>
                            <td class="pl-5" id="invoiceppn">: (PPN 10%) {{ "Rp. " . number_format(($poTotal*$invoice->ppn/100), 2, ',', '.') }} </td>
                        </tr>
                        <tr>
                            <td class="h5 font-weight-bold" style="padding: 1rem 0">Total  </td>
                            <td class="text-left pl-5 h5 font-weight-bold" id="invoiceTotalPrice">: {{ "Rp. " . number_format($poTotal + ($poTotal*$invoice->ppn/100), 2, ',', '.') }}</td>
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
