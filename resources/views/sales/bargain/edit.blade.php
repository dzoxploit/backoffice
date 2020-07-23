@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Edit Penawaran</h4>
        </div>
        <div>
            <form action="{{ url('/sales/bargains/'.$tempBargain->bargain_id.'/cancel') }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Batalkan Perubahan</button>
            </form>
        </div>
    </div>
    <div class="iq-card-body">

        <div class="row">
            <div class="col-8">
                <table>
                    <tr>
                        <td class="pr-4">Bargain ID </td>
                        <td> : {{ $tempBargain->bargain_id ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Customer </td>
                        <td> : {{ $tempBargain->customer_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Dibuat Oleh </td>
                        <td> : {{ $getCreatedBy->createdBy ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Penyunting Terakhir </td>
                        <td> : {{ $lastUpdatedBy->lastUpdatedBy ?? '' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-4 clearfix">
                <table class="float-right">
                    <tr class="text-right">
                        <td class="pr-4">tgl. Expr Penawaran :</td>
                        <td>{{ !empty($tempBargain) ? date('Y-m-d', strtotime($tempBargain->bargain_expr)) : '' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="note">Note :</label>
                <textarea class="form-control" name="bargain-bargain-note" id="inputEditbargainNote"
                    rows="2">{{ $tempBargain->bargain_note ?? '' }}</textarea>
            </div>
        </div>
        <div class="d-flex float-right my-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal" id="addProductEdit">
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
                    <th>Total Harga Produk</th>
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
                        <td>{{ "Rp " . number_format($tdb->unit_price,2,',','.') }}
                        </td>
                        <td>{{ "Rp " . number_format($tdb->unit_price*$tdb->qty,2,',','.') }}
                        </td>
                        <td>{{ "Rp " . number_format($tdb->bargain_price,2,',','.') }}
                        </td>
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
                                    <input type="text" value="edit" name="actiontype" hidden>
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
                                <input type="number" placeholder="" id="inputEditBargainDiscount" class="dm-input"
                                    value="{{ $tempBargain->discount }}">
                                <select id="inputEditBargainDiscountType" class="dm-input-dropdown">
                                    <option value=""
                                        {{ empty($tempBargain->discount_type) ? 'selected' : '' }}>
                                        -</option>
                                    <option value="%"
                                        {{ $tempBargain->discount_type == '%' ? 'selected' : '' }}>
                                        %</option>
                                    <option value="$"
                                        {{ $tempBargain->discount_type == '$' ? 'selected' : '' }}>
                                        Rp.</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5 h4" style="padding: 1rem 0">Total :</td>
                            <td class="text-right pl-5 h4" style="padding: 1rem 0" id="bargainCustomerTotalHarga">-</td>
                        </tr>
                    </table>
                    <button class="float-right my-2 mx-1 btn btn-primary" id="saveEditBargainCustomer">Save</button>
                    
                    <form action="{{ url('/sales/bargains/temp/edit/default') }}" method="post" class="d-inline-block float-right my-2">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-danger" value="Default">
                    </form>

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
                        <input type="text" name="actiontype" value="edit" hidden>
                        <input type="text" name="prod_id" id="editBargainDetailProdId" hidden>
                        <div class="col-6">
                            <label for="discount">Qty</label>
                            <input type="number" class="form-control" name="qty" id="editBargainDetailQty" value="1">
                        </div>
                        <div class="col-6">
                            <label for="discount">Harga Penawaran</label>
                            <input type="number" class="form-control" name="bargain-price"
                                id="editBargainDetailBargainPrice" value="">
                        </div>
                        <div class="col-6">
                            {{-- <label for="discount">Unit Price</label> --}}
                            <input type="number" class="form-control" name="unit-price" id="editBargainUnitPrice"
                                value="1" hidden>
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

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="addProductModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" id="bargainProductSearch" aria-describedby="emailHelp"
                        placeholder="Search Product Here">
                </div>
                <div class="productData">
                    <table id="searchProductTable" class="table table-striped table-bordered mt-4" role="grid"
                        aria-describedby="user-list-page-info">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Nama Product</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="searchProductTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/assets/js/ajax/salesbargain.js') }}"></script>
<script>
    //=================================================
    /** Calculation total info **/
    //=================================================
    function bargainCustomerCalcSubTotal() {
        $.ajax({
            url: "/sales/bargains/detail/calculation/ajax",
            method: "post",
            data: {
                calc: 'edit'
            },
            success: function (response) {
                $("#bargainCustomerSubTotalHarga").html(response.subTotalPrice);
            },
        });
    }

    bargainCustomerCalcSubTotal();

    //=================================================
    /** Ngitung total kalkulasi dengan discount **/
    //=================================================
    var bargainCustomerTypingTimer;
    $("#inputEditBargainDiscount").on("keyup", function () {
        clearTimeout(bargainCustomerTypingTimer);
        bargainCustomerTypingTimer = setTimeout(bargainCustomerCalcTotal, 500);
    });
    $("inputEditBargainDiscount").on("keydown", function () {
        clearTimeout(bargainCustomerTypingTimer);
    });

    function bargainCustomerCalcTotal() {
        var discount = $("#inputEditBargainDiscount").val();
        var discount_type = $("#inputEditBargainDiscountType").val();
        $.ajax({
            url: "/sales/bargains/detail/calculation/discount/ajax",
            method: "get",
            data: {
                calc : 'edit',
                discount: discount,
                discount_type: discount_type,
            },
            success: function (response) {
                $("#bargainCustomerTotalHarga").html(response.totalPrice);
            },
        });
    }
    bargainCustomerCalcTotal();

    //=================================================
    /** Kalkulasi ketika discount type berubah **/
    //=================================================
    $("#inputEditBargainDiscountType").on("change", function () {
        bargainCustomerCalcTotal();
        if ($(this).val() == '') {
            $('#inputEditBargainDiscount').val('')
        }
    });

</script>
@endsection
