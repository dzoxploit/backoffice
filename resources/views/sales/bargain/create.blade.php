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
                <table>
                    <tr>
                        <td>ID Penawaran</td>
                        <td class="pl-4">
                            :
                            <span>XXXX/Penawaran/DM/</span>
                            <select name="inputSalesInvoiceInvoiceIdCreateRomawi" form="salesInvoiceFormSave"
                                id="inputBargainBargainIdCreateRomawi" form="salesPurchaseOrderTempSave">
                                <option value=""
                                    {{ !empty($arrangeId['romawi']) == '' ? 'selected' : '' }}>
                                    -</option>
                                <option value="I"
                                    {{ !empty($arrangeId['romawi']) == 'I' ? 'selected' : '' }}>
                                    I</option>
                                <option value="II"
                                    {{ !empty($arrangeId['romawi']) == 'II' ? 'selected' : '' }}>
                                    II</option>
                                <option value="III"
                                    {{ !empty($arrangeId['romawi']) == 'III' ? 'selected' : '' }}>
                                    III</option>
                                <option value="IV"
                                    {{ !empty($arrangeId['romawi']) == 'IV' ? 'selected' : '' }}>
                                    IV</option>
                                <option value="V"
                                    {{ !empty($arrangeId['romawi']) == 'V' ? 'selected' : '' }}>
                                    V</option>
                                <option value="VI"
                                    {{ !empty($arrangeId['romawi']) == 'VI' ? 'selected' : '' }}>
                                    VI</option>
                                <option value="VII"
                                    {{ !empty($arrangeId['romawi']) == 'VII' ? 'selected' : '' }}>
                                    VII</option>
                                <option value="VIII"
                                    {{ !empty($arrangeId['romawi']) == 'VIII' ? 'selected' : '' }}>
                                    VIII</option>
                                <option value="IX"
                                    {{ !empty($arrangeId['romawi']) == 'IX' ? 'selected' : '' }}>
                                    IX</option>
                                <option value="X"
                                    {{ !empty($arrangeId['romawi']) == 'X' ? 'selected' : '' }}>
                                    X</option>
                                <option value="XI"
                                    {{ !empty($arrangeId['romawi']) == 'XI' ? 'selected' : '' }}>
                                    XI</option>
                                <option value="XII"
                                    {{ !empty($arrangeId['romawi']) == 'XII' ? 'selected' : '' }}>
                                    XII</option>
                            </select> /
                            <select name="inputBargainBargainIdCreateYear" id="inputBargainBargainIdCreateYear"
                                form="salesInvoiceFormSave">
                                <option value=""
                                    {{ !empty($arrangeId['year']) == '' ? 'selected' : '' }}>
                                    -</option>
                                <option value="2020"
                                    {{ !empty($arrangeId['year']) == '2020' ? 'selected' : '' }}>
                                    2020</option>
                                <option value="2021"
                                    {{ !empty($arrangeId['year']) == '2021' ? 'selected' : '' }}>
                                    2021</option>
                                <option value="2022"
                                    {{ !empty($arrangeId['year']) == '2022' ? 'selected' : '' }}>
                                    2022</option>
                                <option value="2023"
                                    {{ !empty($arrangeId['year']) == '2023' ? 'selected' : '' }}>
                                    2023</option>
                                <option value="2024"
                                    {{ !empty($arrangeId['year']) == '2024' ? 'selected' : '' }}>
                                    2024</option>
                                <option value="2025"
                                    {{ !empty($arrangeId['year']) == '2025' ? 'selected' : '' }}>
                                    2025</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer</td>
                        <td class="pl-4"> :
                            <select name="bargain-customer-id"
                            id="inputBargainCustomerId">
                            <option value="0">Choose Customer</option>
                            @if (!empty($tempBargain->customer_id))
                                    @foreach($customers as $cstmr)
                                        <option value="{{ $cstmr->customer_id }}"
                                            {{ $cstmr->customer_id == $tempBargain->customer_id ? 'selected' : '' }}>
                                            {{ $cstmr->fullname }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach($customers as $cstmr)
                                        <option value="{{ $cstmr->customer_id }}">
                                            {{ $cstmr->fullname }}
                                        </option>
                                    @endforeach    
                                @endif
                        </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table>
                    <tr>
                        <td>Tgl Expr</td>
                        <td class="pl-4">
                            : <input type="date" name="bargain-expr-date"
                            id="inputBargainExpr"
                            value="{{ $tempBargain->bargain_expr ?? '' }}">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="note">Note :</label>
                <textarea class="form-control" name="bargain-bargain-note" id="inputbargainNote"
                    rows="2">{{ $tempBargain->bargain_note ?? '' }}</textarea>
            </div>
        </div>
        <div class="d-flex float-right my-2">
            <button class="btn btn-primary" class="btn btn-primary" data-toggle="modal" data-target="#saveAddProductModal" id="bargainNewAddProduct" >
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tempDetailBargain as $tdb)
                    <tr>
                        <td>{{ $tdb->product_id }}</td>
                        <td>{{ $tdb->product_name }}</td>
                        <td>{{ $tdb->qty }}</td>
                        <td>{{ "Rp " . number_format($tdb->unit_price,2,',','.') }}</td>
                        <td>{{ "Rp " . number_format($tdb->unit_price*$tdb->qty,2,',','.') }}</td>
                            <td>
                            <div class="flex align-items-center list-user-action">
                                <button class="btn btn-warning salesBargainDetailCreate" data-toggle="modal"
                                    data-target="#editDetailCreate" data-placement="top" title="" data-original-title="Edit"
                                    data-id="product-detail-update" data-content=""
                                    dm-data="{{ $tdb->product_id }}">Edit</button>

                                <form
                                    action="{{ url('/sales/bargains/temp/detail/'.$tdb->product_id) }}"
                                    method="post" class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <input type="text" value="save" name="actiontype" hidden>
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
                            <td class="text-right pl-5" id="bargainCustomerSubTotalHargaSave">-</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Discount :</td>
                            <td class="text-right pl-5">
                                <input type="text" placeholder="" id="inputBargainDiscountSave" class="dm-input">
                                <select id="inputBargainTypeDiscountSave" class="dm-input-dropdown">
                                    <option value=""
                                        {{ empty($tempBargain->discount_type) ? 'selected' : '' }}>
                                        -</option>
                                    <option value="%"
                                        {{ !empty($tempBargain->discount_type) == '%' ? 'selected' : '' }}>
                                        %</option>
                                    <option value="$"
                                        {{ !empty($tempBargain->discount_type) == '$' ? 'selected' : '' }}>
                                        Rp.</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5 h4" style="padding: 1rem 0">Total :</td>
                            <td class="text-right pl-5 h4" style="padding: 1rem 0" id="bargainCustomerTotalHargaSave">-</td>
                        </tr>
                    </table>
                    <button class="float-right my-2 mx-1 btn btn-primary" id="saveBargainCustomer">Save</button>
                    <a href="{{ url('/sales/bargains/temp/reset') }}"><button
                            class="float-right my-2 btn btn-danger">Reset</button></a>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="editDetailCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <input type="text" name="actiontype" value="save" hidden>
                        <input type="text" name="prod_id" id="editBargainDetailProdIdCreate" hidden>
                        <div class="col-6">
                            <label for="discount">Qty</label>
                            <input type="number" class="form-control" name="qty" id="editBargainDetailQtyCreate" value="1">
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

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="saveAddProductModal" tabindex="-1" role="dialog"
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
                    <input type="text" class="form-control" id="bargainProductSearchSave" aria-describedby="emailHelp"
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
    function bargainCustomerCalcSubTotalSave() {
        $.ajax({
            url: "/sales/bargains/detail/calculation/ajax",
            method: "post",
            data: {
                calc: 'save'
            },
            success: function (response) {
                $("#bargainCustomerSubTotalHargaSave").html(response.subTotalPrice);
            },
        });
    }

    bargainCustomerCalcSubTotalSave();

     //=================================================
    /** Ngitung total kalkulasi dengan discount **/
    //=================================================
    var bargainCustomerTypingTimer;
    $("#inputBargainDiscountSave").on("keyup", function () {
        clearTimeout(bargainCustomerTypingTimer);
        bargainCustomerTypingTimer = setTimeout(bargainCustomerCalcTotal, 500);
    });
    $("inputBargainDiscountSave").on("keydown", function () {
        clearTimeout(bargainCustomerTypingTimer);
    });

    function bargainCustomerCalcTotal() {
        var discount = $("#inputBargainDiscountSave").val();
        var discount_type = $("#inputBargainTypeDiscountSave").val();
        $.ajax({
            url: "/sales/bargains/detail/calculation/discount/ajax",
            method: "get",
            data: {
                calc : 'save',
                discount: discount,
                discount_type: discount_type,
            },
            success: function (response) {
                $("#bargainCustomerTotalHargaSave").html(response.totalPrice);
            },
        });
    }
    bargainCustomerCalcTotal();

    //=================================================
    /** Kalkulasi ketika discount type berubah **/
    //=================================================
    $("#inputBargainTypeDiscountSave").on("change", function () {
        bargainCustomerCalcTotal();
        if ($(this).val() == '') {
            $('#inputEditBargainDiscount').val('')
        }
    });
</script>
@endsection

