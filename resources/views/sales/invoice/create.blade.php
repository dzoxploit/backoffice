@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{ $pageTitle }}</h4>
        </div>
        <div>
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
                            <span>XXXX/INVOICE/DM/</span>
                            <select name="inputSalesInvoiceInvoiceIdCreateRomawi" form="salesInvoiceFormSave"
                                id="inputBargainCreateRomawi" form="salesPurchaseOrderTempSave">
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
                            <select name="inputSalesInvoiceInvoiceIdCreateYear" id="inputSalesPoPoIdCreateYear"
                                form="salesInvoiceFormSave">
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
                        <td>Po Number</td>
                        <td class="pl-4">
                            :
                            <span>{{ str_pad($poCustomer->po_id, 4, '0', STR_PAD_LEFT).$poCustomer->po_id_format }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Bill To</td>
                        <td class="pl-4"> :
                            <select name="inputSalesInvoiceBillTo" form="salesInvoiceFormSave"
                                id="inputSalesInvoiceBillTo" form="salesPurchaseOrderTempSave">
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
                        <td>Ship To</td>
                        <td class="pl-4"> :
                            <select name="inputSalesInvoiceShipTo" form="salesInvoiceFormSave"
                                id="inputSaleInvoiceShipTo" form="salesPurchaseOrderTempSave">
                                <option value="0">Choose Customer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Faktur Pajak</td>
                        <td class="pl-4"> :
                            <input type="text" form="salesInvoiceFormSave" name="inputSalesInvoiceTax"
                                placeholder="faktur pajak">
                        </td>
                    </tr>

                </table>
            </div>
            <div class="col-4">
                <table>
                    <tr>
                        <td>Terms</td>
                        <td class="pl-4">
                            :
                            <select name="inputSalesInvoiceTerms"
                                form="salesInvoiceFormSave">
                                <option value="0">-</option>
                                <option value="30">30 Hari</option>
                            </select>
                        </td>

                    </tr>
                    <tr>
                        <td>Ship Via</td>
                        <td class="pl-4">
                            :
                            <select name="inputSalesInvoiceShipVia" form="salesInvoiceFormSave">
                                <option>-</option>
                                <option value="internal">Internal</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="cmc">CMC</option>
                                <option value="other">Other</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ship Date</td>
                        <td class="pl-4">
                            : <input type="Date" name="inputSalesInvoiceShipDate" form="salesInvoiceFormSave">
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
                    <th>Product ID</th>
                    <th>Nama Product</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($poCustomerDetail as $pcd)
                    <tr>
                        <td>{{ $pcd->product_id }}</td>
                        <td>{{ $pcd->product_name }}</td>
                        <td>{{ $pcd->qty }}</td>
                        <td>{{ "Rp " . number_format($pcd->unit_price,2,',','.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix py-3">
            <div class="card float-left total-info mt-3 w-50">
                <div class="card-body">
                    <label for="inputNote">Terbilang</label>
                    <input class="form-control" name="inputSalesInvoiceSpell" form="salesInvoiceFormSave"
                        value="{{ $tempPo->note ?? '' }}">
                </div>
            </div>
            <div class="card float-right total-info mt-3">
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="text-right pl-5">Sub Total : </td>
                            <td class="text-right pl-5" id="invoiceCreateTotal">Rp. 0,00</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">
                            </td>
                            <td class="text-right pl-5">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" form="salesInvoiceFormSave" name="inputSalesInvoicePPN" id="ppnswitch">
                                    <label class="custom-control-label" for="ppnswitch">PPN 10%</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Pajak : </td>
                            <td class="text-right pl-5" id="invoiceppn">Rp. 0,00</td>
                        </tr>
                        <td class="text-right pl-5">Freight : </td>
                        <td class="text-right pl-5">
                            <input type="number" placeholder="Ongkir" name="inputSalesInvoiceFreight"
                                form="salesInvoiceFormSave" id="inputSalesInvoiceFreight">
                        </td>
                        <tr>
                            <td class="text-right pl-5">Total Harga : </td>
                            <td class="text-right pl-5" id="invoiceTotalPrice">Rp. 0,00</td>
                        </tr>
                    </table>
                    <form id="salesInvoiceFormSave" action="{{ url('/sales/invoices/new') }}"
                        method="post">
                        @csrf
                        <input type="number" name="po_id"
                            value="{{ app('request')->input('po_id') }}" hidden
                            readonly id="inputSalesInvoicePoId">
                        <button type="submit" class="float-right my-2 mx-1 btn btn-primary"
                            id="saveSalesInvoiceCreate">Save</button>
                    </form>
                    <a href="{{ url()->current() }}"><button
                            class="float-right my-2 btn btn-danger">Reset</button></a>

                </div>
            </div>
            <div class="float-left total-info mt-3">
                <div class="card">
                    <div class="card-body">
                        <label for="inputNote">Note :</label>
                        <textarea class="form-control" name="inputSalesInvoiceNote" form="salesInvoiceFormSave"
                            id="inputSalesInvoiceCreateNote" placeholder="Masukan Note" rows="2"
                            cols="75">{{ $tempPo->note ?? '' }}</textarea>
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
@section('script')
<script src="{{ asset('/assets/js/ajax/sales/invoice.js') }}"></script>
<script>
    //=================================================
    /** Calculation Total info **/
    //=================================================
    function invoiceCustomerCalcTotal(ppn = false) {
        if ($('#ppnswitch').prop('checked') == true) {
            ppn = true
        }
        $.ajax({
            url: "/sales/invoices/invoice/calculation/total/ajax",
            method: "get",
            data: {
                po_id: $('#inputSalesInvoicePoId').val(),
                ppn : ppn,
                freight : $('#inputSalesInvoiceFreight').val(),
            },
            success: function (response) {
                $("#invoiceCreateTotal").html(response.subTotalPrice);
                $("#invoiceTotalPrice").html(response.invoiceTotal);
                $("#invoiceppn").html(response.ppn);
            },
        });
    }

    //run
    invoiceCustomerCalcTotal();

    //=================================================
    //** PPN Switch **/
    //=================================================
    $('#ppnswitch').click(function () {
        if ($(this).prop('checked') == true) {
            invoiceCustomerCalcTotal(true)
        } else {
            invoiceCustomerCalcTotal();
        }
    })

    //=================================================
    /** Ngitung total kalkulasi dengan freight **/
    //=================================================
    var invoiceCustomerTypingTimer;
    $("#inputSalesInvoiceFreight").on("keyup", function () {
        clearTimeout(invoiceCustomerTypingTimer);
        invoiceCustomerTypingTimer = setTimeout(invoiceCustomerCalcTotal, 500);
    });
    $("inputSalesInvoiceFreight").on("keydown", function () {
        clearTimeout(invoiceCustomerTypingTimer);
    });

   

     
    // //=================================================
    // /** Kalkulasi Ongkir **/
    // //=================================================
    // var kalkulasiOngkirTimer;
    // $("#inputSalesInvoiceFreight").on('keyup', function () {
    //     clearTimeout(kalkulasiOngkirTimer)
    //     kalkulasiOngkirTimer = setTimeout(function () {
    //         freight();
    //     }, 500)
    // });
    // $("#inputSalesInvoiceFreight").on('keydown', function () {
    //     clearTimeout(kalkulasiOngkirTimer);
    // })
    // //check Po id tersedia atau tidak
    // function freight() {
    //     var freight;
    //     freight = $('#inputSalesInvoiceFreight').val();

    //     console.log(freight);
    //     // $.ajax({
    //     //     url: '/sales/invoices/invoice/calculation/total/ajax',
    //     //     method: "GET",
    //     //     data: {
    //     //         freight: freight
    //     //     },
    //     //     success: function (response) {
    //     //         console.log(response);
    //     //         $('#invoiceTotalPrice').html(response.invoiceTotal);
    //     //     },
    //     // });
    // }

</script>
@endsection
