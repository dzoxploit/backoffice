@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">New Invoice</h4>
        </div>
        <div>
            <form action="{{ url('invoices/new') }}" class="d-inline-block" method="POST">
                @csrf
                {{-- <button type="submit" data-toggle="tooltip" data-placement="top" id="save-purchase-order"
                    class="btn btn-primary">Save</button> --}}
        </div>
    </div>
    <div class="iq-card-body">
        <div class="row">
            <div class="col-8">
                <div class="form-group row">
                    <label for="invoiceCreatePoId" class="col-2 col-form-label">PO ID :</label>
                    <div class="col">
                        <input class="form-control" type="text" name="invoicePoId" id="inputCreateInvoicePoId" form="invoiceSaveForm">
                    </div>
                    <div class="col-3">
                        <div class="btn btn-primary" id="invoicePoIdCheck">Status</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNoInvoice" class="col-2 col-form-label">No. Invoice :</label>
                    <div class="col">
                        <input class="form-control" type="text" name="invoiceNum" form="invoiceSaveForm" id="inputCreateInvoiceNum">
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group row">
                    <label for="inputDueDate" class="col-2 col-form-label">Due Date :</label>
                    <div class="col">
                        <input class="form-control" type="date" id="inputCreateInvoiceDueDate" name="due-date" form="invoiceSaveForm"
                            value="{{ $tempPo->date ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="inputNote">Note :</label>
                <textarea class="form-control" name="note" id="inputCreateInvoiceNote" form="invoiceSaveForm"
                    rows="2">{{ $tempPo->note ?? '' }}</textarea>
            </div>
        </div>
        </form>
        <div class="clearfix py-3">
            <div class="card float-left total-info">
                <div class="card-body">
                    <h5 class="card-title"><b>Invoice Attachment</b></h5>
                    <input type="file" name="invoiceAttachment" id="salesPoCustomerAttachment" accept="image/png, image/jpeg" form="invoiceSaveForm">
                </div>
            </div>
            <div class="card float-right total-info">
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="text-right pl-5">PO Total : </td>
                            <td class="text-right pl-5" id="poTotal">Rp. 0,00</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">
                            </td>
                            <td class="text-right pl-5">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="ppnswitch" name="ppn" form="invoiceSaveForm">
                                    <label class="custom-control-label" for="ppnswitch">PPN 10%</label>
                                 </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Pajak : </td>
                            <td class="text-right pl-5" id="invoiceppn">Rp. 0,00</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Total Harga : </td>
                            <td class="text-right pl-5" id="invoiceTotalPrice">Rp. 0,00</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Harga Bayar :</td>
                            <td class="text-right pl-5">
                                <input type="number" placeholder="" id="inputCreateInvoicePricePaid" name="paid_price" form="invoiceSaveForm" class="dm-input">
                            </td>
                        </tr>
                    </table>
                    <form action="{{ url('/invoices/new') }}" enctype="multipart/form-data"  method="post" id="invoiceSaveForm">
                        @csrf
                        <button type="submit" class="float-right my-2 mx-1 btn btn-primary" >Save</button>
                    </form>
                    <a href="{{ url('/purchaseorders/temp/reset') }}"><button class="float-right my-2 btn btn-danger">Reset</button></a>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Purchase Order</h4>
        </div>
        <div>
            <form action="{{ url('purchase/order/new') }}" class="d-inline-block" method="POST">
        </div>
    </div>
    <div class="iq-card-body">

        <div class="row">
            <div class="col-8">
                <div class="form-group row">
                    <label for="supplier-option" class="col-2 col-form-label">Supplier :</label>
                    <div class="col">
                        Nama supplier
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount" class="col-2 col-form-label">Discount :</label>
                    <div class="col">
                        20%
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group row">
                    <label for="po-date" class="col-2 col-form-label">Tgl :</label>
                    <div class="col">
                        17/11/2002
                    </div>
                </div>
                <div class="form-group row">
                    <label for="po-num" class="col-3 col-form-label">No. PO :</label>
                    <div class="col">
                        12039Aoisdf/OAIsd
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="note">Note :</label>
                <textarea class="form-control" name="note" id="note"
                    rows="2" readonly>Lorem Ipsum Dolor sit amet</textarea>
            </div>
        </div>
        </form>
        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
            aria-describedby="user-list-page-info">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Nama Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Discount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tempDetailPo as $tdpo)
                    <tr>
                        <td>{{ $tdpo->product_id }}</td>
                        <td>{{ $tdpo->product_name }}</td>
                        <td>{{ $tdpo->qty }}</td>
                        <td>{{ $tdpo->price }}</td>
                        <td>{{ $tdpo->discount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- <div class="row justify-content-between mt-3">
            <div id="user-list-page-info" class="col-md-6">
                <span>Showing 1 to 5 of 5 entries</span>
            </div>
            <div class="col-md-6">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div> -->
    </div>

</div> --}}

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
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/assets/js/ajax/purchase/invoice.js') }}"></script>
@endsection
