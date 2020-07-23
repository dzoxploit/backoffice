@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">New Purchase Order</h4>
        </div>
        <div>

        </div>
    </div>
        <div class="iq-card-body">
            <table>
                <tr>
                    <td>ISD</td>
                    <td class="pl-4">
                        :
                        <span>XXXX/ISDN/DM/</span>
                        <select name="inputSalesPoPoIdCreateRomawi" id="inputSalesPoPoIdCreateRomawi" form="salesPurchaseOrderTempSave">
                            <option value="-"
                                {{ $arrangeId['romawi'] ?? '' == '' ? 'selected' : '' }}>
                                -</option>
                            <option value="I"
                                {{ $arrangeId['romawi'] ?? '' == 'I' ? 'selected' : '' }}>
                                I</option>
                            <option value="II"
                                {{ $arrangeId['romawi'] ?? '' == 'II' ? 'selected' : '' }}>
                                II</option>
                            <option value="III"
                                {{ $arrangeId['romawi'] ?? '' == 'III' ? 'selected' : '' }}>
                                III</option>
                            <option value="IV"
                                {{ $arrangeId['romawi'] ?? '' == 'IV' ? 'selected' : '' }}>
                                IV</option>
                            <option value="V"
                                {{ $arrangeId['romawi'] ?? '' == 'V' ? 'selected' : '' }}>
                                V</option>
                            <option value="VI"
                                {{ $arrangeId['romawi'] ?? '' == 'VI' ? 'selected' : '' }}>
                                VI</option>
                            <option value="VII"
                                {{ $arrangeId['romawi'] ?? '' == 'VII' ? 'selected' : '' }}>
                                VII</option>
                            <option value="VIII"
                                {{ $arrangeId['romawi'] ?? '' == 'VIII' ? 'selected' : '' }}>
                                VIII</option>
                            <option value="IX"
                                {{ $arrangeId['romawi'] ?? '' == 'IX' ? 'selected' : '' }}>
                                IX</option>
                            <option value="X"
                                {{ $arrangeId['romawi'] ?? '' == 'X' ? 'selected' : '' }}>
                                X</option>
                            <option value="XI"
                                {{ $arrangeId['romawi'] ?? '' == 'XI' ? 'selected' : '' }}>
                                XI</option>
                            <option value="XII"
                                {{ $arrangeId['romawi'] ?? '' == 'XII' ? 'selected' : '' }}>
                                XII</option>
                        </select> /
                        <select name="inputSalesPoPoIdCreateYear" id="inputSalesPoPoIdCreateYear" form="salesPurchaseOrderTempSave">
                            <option value="-"
                                {{ $arrangeId['year'] ?? '' == '' ? 'selected' : '' }}>
                                -</option>
                            <option value="2020"
                                {{ $arrangeId['year'] ?? '' == '2020' ? 'selected' : '' }}>
                                2020</option>
                            <option value="2021"
                                {{ $arrangeId['year'] ?? '' == '2021' ? 'selected' : '' }}>
                                2021</option>
                            <option value="2022"
                                {{ $arrangeId['year'] ?? '' == '2022' ? 'selected' : '' }}>
                                2022</option>
                            <option value="2023"
                                {{ $arrangeId['year'] ?? '' == '2023' ? 'selected' : '' }}>
                                2023</option>
                            <option value="2024"
                                {{ $arrangeId['year'] ?? '' == '2024' ? 'selected' : '' }}>
                                2024</option>
                            <option value="2025"
                                {{ $arrangeId['year'] ?? '' == '2025' ? 'selected' : '' }}>
                                2025</option>
                        </select>
                    </td>
                </tr>
                <tr>
                <td>Customer</td>
                <td class="pl-4"> :
                    <select name="inputSalesPoCustomerIdCreate" id="inputSalesPoCustomerIdCreate" form="salesPurchaseOrderTempSave">
                        <option value="0">Choose Customer</option>
                        @foreach($customers as $cstmr)
                            <option value="{{ $cstmr->customer_id }}"
                                {{ $tempPo->customer_id ?? 0 == $cstmr->customer_id  ? 'selected' : '' }}>
                                {{ $cstmr->fullname }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
                <tr>
                    <td>
                        ID Penawaran
                    </td>
                    <td class="pl-4">
                        : <input form="salesPurchaseOrderTempSave" type="text" name="inputSalesPoBargainIdCreate" id="inputSalesPoBargainIdCreate" placeholder="Masukan Nomor Penawaran"
                            value="{{ $tempPo->bargain_id ?? '' }}">
                        <button class="btn btn-primary" id="salesPoBargainIdCheck">status</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        No. PO Customer
                    </td>
                    <td class="pl-4">
                        : <input form="salesPurchaseOrderTempSave" type="text" name="inputSalesPoPoNumCreate" id="inputSalesPoPoNumCreate" placeholder="Masukan Nomor PO Customer"
                            value="{{ $tempPo->po_num ?? '' }}">
                    </td>
                </tr>
            </table>
            <div class="row">
                <div class="col">
                    <label for="note">Note :</label>
                    <textarea class="form-control" name="inputSalesPoNoteCreate" form="salesPurchaseOrderTempSave" id="inputSalesPoNoteCreate"
                        rows="2">{{ $tempPo->po_note ?? '' }}</textarea>
                </div>
            </div>
            <div class="d-flex float-right my-2">
                <button class="btn btn-primary" id="purchaseOrderProductSearchProduct" data-toggle="modal"
                    data-target="#salesPoAddProductModal">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tempDetailPo as $tdpo)
                        <tr>
                            <td>{{ $tdpo->product_id }}</td>
                            <td>{{ $tdpo->product_name }}</td>
                            <td>{{ $tdpo->qty }}</td>
                            <td>{{ "Rp " . number_format($tdpo->unit_price,2,',','.') }}
                            </td>
                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <button class="btn btn-warning customerPoDetailEdit" data-toggle="modal"
                                        data-target="#editdetail" data-placement="top" title=""
                                        data-original-title="Edit" data-id="product-detail-update" data-content=""
                                        dm-data="{{ $tdpo->product_id }}">Edit</button>

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
            <div class="clearfix py-3">
                <div class="card float-left total-info">
                    <div class="card-body">
                        <h5 class="card-title"><b>Hard Copy Po</b></h5>
                        <input type="file" name="salesPoCustomerAttachment" id="salesPoCustomerAttachment" accept="image/png, image/jpeg" form="salesPurchaseOrderTempSave">
                    </div>
                </div>
                <div class="card float-right total-info">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td class="pr-5">Sub Total</td>
                                <td class="text-left">: <span id="salesPurchaseSubTotalHargaCreate">-</span></td>
                            </tr>
                            <tr>
                                <td>Discount </td>
                                <td class="text-left">
                                    : <input type="text" placeholder="" form="salesPurchaseOrderTempSave" name="salesPurchaseOrderDiscount" id="salesPurchaseOrderDiscount"
                                        class="dm-input">
                                    <select name="salesPurchaseOrderDiscountType" form="salesPurchaseOrderTempSave" id="salesPurchaseOrderDiscountType" class="dm-input-dropdown">
                                        <option>-</option>
                                        <option value="%">%</option>
                                        <option value="$">Rp.</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="font-weight-bold h4">
                                <td class="" style="padding: 1rem 0">Total</td>
                                <td class="text-left" style="padding: 1rem 0">
                                    :<span id="salesPurchaseOrderTotalHarga">-</span>
                                </td>
                            </tr>
                        </table>
                        <form action="{{ url('/sales/purchaseorders/new') }}"  method="POST" enctype="multipart/form-data"id="salesPurchaseOrderTempSave">
                            @csrf
                        <input type="submit" class="float-right my-2 mx-1 btn btn-primary" value="save">
                        </form>
                        <a href="{{ url('/sales/purchaseorders/temp/reset') }}"><button
                                class="float-right my-2 btn btn-danger">Reset</button>
                        </a>
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
            <form action="{{ url('/sales/purchaseorders/temp/detail') }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="prod_id" id="salesPoEditProductIdCustomer" hidden>
                        <div class="col-6">
                            <label for="discount">Qty</label>
                            <input type="number" class="form-control" name="qty" id="salesPoEditDetailCustomerQty"
                                value="1">
                        </div>
                        <div class="col-6">
                            <label for="salesPoEditDetailCustomerUnitPrice">Unit Price</label>
                            <input type="number" class="form-control" name="unit_price"
                                id="salesPoEditDetailCustomerUnitPrice" value="">
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
<div class="modal fade bd-example-modal-lg" id="salesPoAddProductModal" tabindex="-1" role="dialog"
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
                    <input type="text" class="form-control" id="inputSalesPoSearchProductCreate"
                        aria-describedby="emailHelp" placeholder="Search Product Here">
                </div>
                <div class="productData">
                    <table id="salesPoSearchProductResultCreate" class="table table-striped table-bordered mt-4"
                        role="grid" aria-describedby="user-list-page-info">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Nama Product</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="salesPoSearchProductResultTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/assets/js/ajax/sales/salespurchase-order.js') }}"></script>
<script>
    //=================================================
    /** Calculation total info **/
    //=================================================
    function salesPurchaseCalcSubTotalSave() {
        $.ajax({
            url: "/sales/purchaseorders/detail/calculation/ajax",
            method: "post",
            success: function (response) {
                $("#salesPurchaseSubTotalHargaCreate").html(response.subTotalPrice);
            },
        });
    }

    salesPurchaseCalcSubTotalSave();

    //=================================================
    /** Ngitung total kalkulasi dengan discount **/
    //=================================================
    var salesPoCustomerTypingTimer;
    $("#salesPurchaseOrderDiscount").on("keyup", function () {
        clearTimeout(salesPoCustomerTypingTimer);
        salesPoCustomerTypingTimer = setTimeout(salesPoCustomerCalcTotal, 500);
    });
    $("salesPurchaseOrderDiscount").on("keydown", function () {
        clearTimeout(salesPoCustomerTypingTimer);
    });

    function salesPoCustomerCalcTotal() {
        var discount = $("#salesPurchaseOrderDiscount").val();
        var discount_type = $("#salesPurchaseOrderDiscountType").val();
        $.ajax({
            url: "/sales/purchaseorders/detail/calculation/discount/ajax",
            method: "get",
            data: {
                discount: discount,
                discount_type: discount_type,
            },
            success: function (response) {
                $("#salesPurchaseOrderTotalHarga").html(response.totalPrice);
                if (!$('#salesPurchaseOrderDiscount').val()) {
                    $('#salesPurchaseOrderDiscountType').val('-')
                }
            },
        });
    }
    salesPoCustomerCalcTotal();

    //=================================================
    /** Kalkulasi ketika discount type berubah **/
    //=================================================
    $("#salesPurchaseOrderDiscountType").on("change", function () {
        salesPoCustomerCalcTotal();
        if (!$(this).val()) {
            $('#salesPurchaseOrderDiscount').val('')
        }
    });

</script>
@endsection
