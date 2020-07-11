@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">New Purchase Order</h4>
        </div>
        <div>
            <a data-toggle="tooltip" data-placement="top" class="btn btn-primary"
                href="{{ url('/sales/purchaseorders/temp/reset') }}">Reset</a>
            <form action="{{ url()->current() }}" method="POST" class="d-inline-block">
                @csrf
                <button type="submit" data-toggle="tooltip" data-placement="top" id="save-purchase-order"
                    class="btn btn-primary">Save</button>
        </div>
    </div>
    <div class="iq-card-body">
       
        <div class="row">
            <div class="col-8">
                <div class="form-group row">
                    <label for="po-num" class="col-3 col-form-label">No. PO Internal:</label>
                    <div class="col">
                        <input class="form-control" type="text" name="purchase-order-po-id" id="inputPurchaseOrderCustomerPoId"
                            value="{{ $tempPo->po_id ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="supplier-option" class="col-2 col-form-label">Customer :</label>
                    <div class="col">
                        <select class="form-control" name="purchase-order-customer-id" id="inputPurchaseOrderCustomerId">
                            <option value="0">Choose Customer</option>
                            @foreach($customers as $cstmr)
                                <option value="{{ $cstmr->customer_id }}"
                                    {{ $tempPo->customer_id ?? 0 == $cstmr->customer_id  ? 'selected' : '' }}>{{ $cstmr->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount" class="col-2 col-form-label">Discount :</label>
                    <div class="col">
                        <input class="form-control" type="text" name="purchase-order-discount" id="inputPurchaseOrderCustomerPoDiscount"
                            value="{{ $tempPo->po_discount ?? '' }}">
                    </div>
                    <div class="col-3">
                        <select class="form-control" name="purchase-order-type" id="inputPurchaseOrderCustomerDiscountType">
                            <option value="0">Discount Type</option>
                            <option value="%"
                                {{ !empty($tempPo->po_discount_type) == '%' ? 'selected' : '' }}>
                                %</option>
                            <option value="$"
                                {{ !empty($tempPo->po_discount_type) == '$' ? 'selected' : '' }}>
                                $</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-4">
                
                <div class="form-group row">
                    <label for="po-num" class="col-3 col-form-label">No. PO :</label>
                    <div class="col">
                        <input class="form-control" type="text" name="purchase-order-po-num" id="inputPurchaseOrderCustomerPoNum"
                            value="{{ $tempPo->po_id ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="po-num" class="col-3 col-form-label">ID. Penawaran:</label>
                    <div class="col">
                        <input class="form-control" type="text" name="purchase-order-id-penawaran" id="inputPurchaseOrderCustomerIdPenawaran"
                            value="{{ $tempPo->po_num ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="note">Note :</label>
                <textarea class="form-control" name="purchase-order-note" id="inputPurchaseOrderCustomerNote"
                    rows="2">{{ $tempPo->po_note ?? '' }}</textarea>
            </div>
        </div>
        </form>
        <div class="d-flex float-right my-2">
            <button class="btn btn-primary" id="purchaseOrderProductSearchProduct">
                Add Product
            </button>
        </div>
        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
            aria-describedby="user-list-page-info">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Nama Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tempDetailPo as $tdpo)
                    <tr>
                        <td>{{ $tdpo->product_id }}</td>
                        <td>{{ $tdpo->product_name }}</td>
                        <td>{{ $tdpo->qty }}</td>
                        <td>{{ "Rp " . number_format($tdpo->price,2,',','.') }}</td>
                        <td>{{ $tdpo->discount.'%' }}</td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                                <button class="btn btn-warning customerPoDetailEdit" data-toggle="modal" data-target="#editdetail" data-placement="top" title=""
                                    data-original-title="Edit" data-id="product-detail-update"
                                    data-content="" dm-data="{{ $tdpo->product_id }}">Edit</button>

                                <form
                                    action="{{ url('/sales/purchaseorders/temp/detail/'.$tdpo->product_id) }}"
                                    method="post" class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger" type="submit" data-toggle="tooltip"
                                        data-placement="top" title="" data-original-title="Delete">Delete</button>
                                </form>

                            </div>
                        </td>
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
            <form action="{{ url('/sales/purchaseorders/temp/detail') }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="prod_id" id="poEditProductIdCustomer" hidden>
                        <div class="col-6">
                            <label for="discount">Qty</label>
                            <input type="number" class="form-control" name="qty" id="editDetailCustomerQty" value="1">
                        </div>
                        <div class="col-6">
                            <label for="discount">Discount</label>
                            <input type="number" class="form-control" name="discount" id="editDetailCustomerDiscount" value="">
                            <small>angka dalam persen (%)</small>
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
<script src="{{ asset('/assets/js/ajax/salespurchase-order.js') }}"></script>
@endsection