@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{ $pageTitle }}</h4>
        </div>
        <div>
            <a href="{{ url('/sales/invoices/pdf/'.$salesInvoice->invoice_id) }}"><button class="btn btn-primary">Print To PDF</button></a>
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
                            <span><span>{{ str_pad($salesInvoice->invoice_id, 4, '0', STR_PAD_LEFT).$salesInvoice->invoice_id_format }}</span></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Po Number</td>
                        <td class="pl-4">
                            :
                            <span>{{ str_pad($salesInvoice->po_id, 4, '0', STR_PAD_LEFT).$salesInvoice->po_id_format }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Bill To</td>
                        <td class="pl-4"> :
                            {{ $salesInvoice->bill_to }}
                        </td>
                    </tr>
                    <tr>
                        <td>Ship To</td>
                        <td class="pl-4"> :
                            {{ $salesInvoice->ship_to }}
                        </td>
                    </tr>
                    <tr>
                        <td>Faktur Pajak</td>
                        <td class="pl-4"> :
                            {{ $salesInvoice->tax_invoice }}
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
                            {{ $salesInvoice->terms.' Hari' }}
                        </td>

                    </tr>
                    <tr>
                        <td>Ship Via</td>
                        <td class="pl-4">
                            :
                            {{ ucfirst($salesInvoice->ship_via) }}
                        </td>
                    </tr>
                    <tr>
                        <td>Ship Date</td>
                        <td class="pl-4">
                            : {{ $salesInvoice->ship_date }}
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
                    <label for="inputNote">Eja</label>
                    <input class="form-control" name="inputSalesInvoiceSpell" form="salesInvoiceFormSave"
                        value="{{ $salesInvoice->spell }}" readonly>
                </div>
            </div>
            <div class="card float-right total-info mt-3">
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="text-right pl-5">Sub Total : </td>
                            <td class="text-right pl-5">{{ $totalPrice['subTotalPrice'] }}</td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Pajak : </td>
                            <td class="text-right pl-5">{{ $totalPrice['ppn'] }}</td>
                        </tr>
                        <td class="text-right pl-5">Freight : </td>
                        <td class="text-right pl-5">{{ $totalPrice['freight'] }}</td>
                        <tr>
                            <td class="text-right pl-5">Total Harga : </td>
                            <td class="text-right pl-5">{{ $totalPrice['invoiceTotal'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="float-left total-info mt-3">
                <div class="card">
                    <div class="card-body">
                        <label for="inputNote">Note :</label>
                        <textarea class="form-control" name="inputSalesInvoiceNote" form="salesInvoiceFormSave"
                            id="inputSalesInvoiceCreateNote" placeholder="Masukan Note" rows="2"
                            cols="75" readonly>{{ $salesInvoice->notes ?? '' }}</textarea>
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

</script>
@endsection
