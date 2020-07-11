@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Tambah Penawaran</h4>
        </div>
    </div>
    <div class="iq-card-body">

        <div class="row">
            <div class="col-8">
                <div class="form-group row">
                    <label for="po-num" class="col-3 col-form-label">ID Penawaran</label>
                    <div class="col">
                        <input class="form-control" type="text" name="bargain-bargain-id"
                            id="inputBargainBargainId"
                            value="{{ $tempBargain->bargain_id ?? '' }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="supplier-option" class="col-2 col-form-label">Customer</label>
                    <div class="col">
                        <select class="form-control" name="bargain-customer-id"
                            id="inputBargainCustomerId">
                            <option value="0">Choose Customer</option>
                            @foreach($customers as $cstmr)
                                <option value="{{ $cstmr->customer_id }}"
                                    {{ $tempBargain->customer_id ?? 0 == $cstmr->customer_id  ? 'selected' : '' }}>
                                    {{ $cstmr->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-4">

                <div class="form-group row">
                    <label for="po-num" class="col-3 col-form-label">Tgl. Expr :</label>
                    <div class="col">
                        <input class="form-control" type="date" name="bargain-expr-date"
                            id="inputBargainExpr"
                            value="{{ $tempBargain->bargain_expr ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="note">Note :</label>
                <textarea class="form-control" name="bargain-bargain-note" id="inputbargainNote"
                    rows="2">{{ $tempBargain->bargain_note ?? '' }}</textarea>
            </div>
        </div>
        <div class="d-flex float-right my-2">
            <button class="btn btn-primary" id="bargainNewAddProduct">
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
                    <th>Unit Price</th>
                    <th>Harga Penawaran</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tempDetailBargain as $tdb)
                    <tr>
                        <td>{{ $tdb->product_id }}</td>
                        <td>{{ $tdb->product_name }}</td>
                        <td>{{ $tdb->qty }}</td>
                        <td>{{ $tdb->unit_price }}</td>
                        <td>{{ $tdb->bargain_price }}</td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                                <button class="btn btn-warning salesBargainDetailEdit" data-toggle="modal"
                                    data-target="#editdetail" data-placement="top" title="" data-original-title="Edit"
                                    data-id="product-detail-update" data-content=""
                                    dm-data="{{ $tdb->product_id }}">Edit</button>

                                <form
                                    action="{{ url('/sales/bargains/temp/detail/'.$tdb->product_id) }}"
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
        <div class="clearfix py-3">
            <div class="card float-right total-info">
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="text-right pl-5">Sub Total :</td>
                            <td class="text-right pl-5" id="bargainCustomerSubTotalHarga">-</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Discount :</td>
                            <td class="text-right pl-5">
                                <input type="text" placeholder="" id="inputBargainDiscount" class="dm-input">
                                <select id="inputBargainDiscountType" class="dm-input-dropdown">
                                    <option value="%">%</option>
                                    <option value="$">Rp.</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5 h4" style="padding: 1rem 0">Total :</td>
                            <td class="text-right pl-5 h4" style="padding: 1rem 0" id="bargainCustomerTotalHarga">-</td>
                        </tr>
                    </table>
                    <button class="float-right my-2 mx-1 btn btn-primary" id="saveBargainCustomer">Save</button>
                    <a href="{{ url('/sales/bargains/temp/reset') }}"><button
                            class="float-right my-2 btn btn-danger">Reset</button></a>

                </div>
            </div>
        </div>
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
            <form action="{{ url('/sales/bargains/temp/detail') }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="prod_id" id="editBargainDetailProdId" hidden>
                        <div class="col-6">
                            <label for="discount">Qty</label>
                            <input type="number" class="form-control" name="qty" id="editBargainDetailQty" value="1">
                        </div>
                        <div class="col-6">
                            <label for="discount">Harga Penawaran</label>
                            <input type="number" class="form-control" name="bargain-price" id="editBargainDetailBargainPrice"
                                value="">
                        </div>
                        <div class="col-6">
                            <label for="discount">Unit Price</label>
                            <input type="number" class="form-control" name="unit-price" id="editBargainUnitPrice" value="1">
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
<script src="{{ asset('/assets/js/ajax/salesbargain.js') }}"></script>
@endsection

