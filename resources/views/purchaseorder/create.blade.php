@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Form Surat Pesanan Baru</h4>
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
                            <span>PO/PPS-DM/</span>
                            <select name="purchase_po_id_romawi" id="inputPurchasePoIdCreateRomawi"
                                form="purchaseOrderSaveForm">
                                <option value=""
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == '') ? 'selected' : ''}}>
                                    -</option>
                                <option value="I"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'I') ? 'selected' : ''}}>
                                    I</option>
                                <option value="II"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'II') ? 'selected' : ''}}>
                                    II</option>
                                <option value="III"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'III') ? 'selected' : ''}}>
                                    III</option>
                                <option value="IV"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'IV') ? 'selected' : ''}}>
                                    IV</option>
                                <option value="V"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'V') ? 'selected' : ''}}>
                                    V</option>
                                <option value="VI"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'VI') ? 'selected' : ''}}>
                                    VI</option>
                                <option value="VII"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'VII') ? 'selected' : ''}}>
                                    VII</option>
                                <option value="VIII"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'VIII') ? 'selected' : ''}}>
                                    VIII</option>
                                <option value="IX"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'IX') ? 'selected' : ''}}>
                                    IX</option>
                                <option value="X"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'X') ? 'selected' : ''}}>
                                    X</option>
                                <option value="XI"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'XI') ? 'selected' : ''}}>
                                    XI</option>
                                <option value="XII"
                                {{ (!empty($arrangeId) && $arrangeId['romawi'] == 'XII') ? 'selected' : ''}}>
                                    XII</option>
                            </select> /
                            <select id="inputPurchasePoIdCreateYear" name="purchase_po_id_year"
                                form="purchaseOrderSaveForm">
                                <option value=""
                                {{ (!empty($arrangeId) && $arrangeId['year'] == '') ? 'selected' : ''}}>
                                    -</option>
                                <option value="2020"
                                {{ (!empty($arrangeId) && $arrangeId['year'] == '2020') ? 'selected' : ''}}>
                                    2020</option>
                                <option value="2021"
                                {{ (!empty($arrangeId) && $arrangeId['year'] == '2021') ? 'selected' : ''}}>
                                    2021</option>
                                <option value="2022"
                                {{ (!empty($arrangeId) && $arrangeId['year'] == '2022') ? 'selected' : ''}}>
                                    2022</option>
                                <option value="2023"
                                {{ (!empty($arrangeId) && $arrangeId['year'] == '2023') ? 'selected' : ''}}>
                                    2023</option>
                                <option value="2024"
                                {{ (!empty($arrangeId) && $arrangeId['year'] == '2024') ? 'selected' : ''}}>
                                    2024</option>
                                <option value="2025"
                                {{ (!empty($arrangeId) && $arrangeId['year'] == '2025') ? 'selected' : ''}}>
                                    2025</option>
                            </select> / 
                            <span>XXX</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Vendor</td>
                        <td class="pl-4"> :
                            <select name="purchase_supplier_id" form="purchaseOrderSaveForm" id="purchaseNewSupplier"
                                form="salesPurchaseOrderTempSave">
                                <option value="">Choose Supplier</option>
                                @if (!empty($tempPo))
                                    @foreach($suppliers as $spl)
                                        <option value="{{ $spl->sup_id }}"
                                            {{ $spl->sup_id == $tempPo->sup_id ? 'selected' : '' }}>
                                            {{ $spl->sup_name }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach($suppliers as $spl)
                                        <option value="{{ $spl->sup_id }}">
                                            {{ $spl->sup_name }}
                                        </option>
                                    @endforeach    
                                @endif
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Syarat Pembayaran</td>
                        <td class="pl-4"> :
                            <select name="purchase_syarat_pemabayaran" form="purchaseOrderSaveForm" id="purchaseNewPaymentTerm">
                                <option value="">Pilih</option>
                                <option value="0">Cash</option>
                                <option value="7" {{(!empty($tempPo) && $tempPo->payment_term == '7') ? 'selected' : ''}}>7hr</option>
                                <option value="14" {{(!empty($tempPo) && $tempPo->payment_term == '14') ? 'selected' : ''}}>14hr</option>
                                <option value="30" {{(!empty($tempPo) && $tempPo->payment_term == '30') ? 'selected' : ''}}>30hr</option>
                                <option value="45" {{(!empty($tempPo) && $tempPo->payment_term == '45') ? 'selected' : ''}}>45hr</option>
                                <option value="60" {{(!empty($tempPo) && $tempPo->payment_term == '60') ? 'selected' : ''}}>60hr</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Contact Person</td>
                        <td class="pl-4"> :
                            <select name="purchase_contact_person" form="purchaseOrderSaveForm" id="purchaseNewContactPerson">
                                <option value="">Pilih</option>
                                @foreach ($contactPerson as $cp)
                                    <option value="{{ $cp->id_user }}" 
                                        {{(!empty($tempPo) && $spl->sup_id == $tempPo->sup_id) ? 'selected' : ''}}>
                                        {{ $cp->fullname }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <table>
                    <tr>
                        <td>Tgl PO :</td>
                        <td class="pl-4">
                            : <input type="Date" name="purchase_po_date" id="po-date" form="purchaseOrderSaveForm"
                                value="{{ $tempPo->date ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Request :</td>
                        <td class="pl-4">
                            : <input type="text" name="purchase_po_request" id="purchaseNewRequest" form="purchaseOrderSaveForm" value="{{ $tempPo->po_request ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Delivery date :</td>
                        <td class="pl-4">
                            : <input type="Date" name="purchase_po_delivery_date" id="purchaseNewDeliveryDate" form="purchaseOrderSaveForm"
                                value="{{ $tempPo->delivery_date ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat Penyerahan :</td>
                        <td class="pl-4">
                            : <input type="text" name="purchase_po_tempat_penyerahan" id="purchaseNewDeliveryPoint" form="purchaseOrderSaveForm"
                                value="{{ $tempPo->delivery_point ?? '' }}">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="note">Note :</label>
                <textarea class="form-control" name="purchase_po_note" id="note" form="purchaseOrderSaveForm"
                    rows="2">{{ $tempPo->note ?? '' }}</textarea>
            </div>
        </div>
        <div class="d-flex float-right my-2">
            <button class="btn btn-primary" id="search-product" data-toggle="modal" data-target="#poAddProductModal" >
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
                    <th>Unit</th>
                    <th>Unit Price</th>
                    <th>Discount</th>
                    <th>Ammount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tempDetailPo as $tdpo)
                    <tr>
                        <td>{{ $tdpo->product_id }}</td>
                        <td>{{ $tdpo->product_name }}</td>
                        <td>{{ $tdpo->qty }}</td>
                        <td>{{ $tdpo->unit }}</td>
                        <td>{{ "Rp. " . number_format($tdpo->unit_price,2,',','.') }}
                        
                        <td>{{ $tdpo->discount.'%' }}</td>
                    </td>
                    @php
                        $hargaDetail = $tdpo->unit_price * $tdpo->qty;
                        $discount = ($tdpo->discount/100) * $hargaDetail;
                        $subTotal = $hargaDetail - $discount;
                    @endphp
                    <td>{{ "Rp. " . number_format($subTotal,2,',','.') }}
                    </td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                                <button class="btn btn-warning poDetailUpdate" data-toggle="modal"
                                    data-target="#editdetail" data-placement="top" title="" data-original-title="Edit"
                                    data-id="product-detail-update" data-content=""
                                    dm-data="{{ $tdpo->product_id }}">Edit</button>

                                <form
                                    action="{{ url('/purchaseorders/temp/detail/'.$tdpo->product_id) }}"
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
            <div class="float-left total-info mt-3">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <label for="inputNote">Yang Membuat :</label>
                            <select name="purchase_po_yang_membuat" form="purchaseOrderSaveForm" id="purchase_po_yang_membuat">
                                <option value="">Pilih</option>
                                @foreach ($authorization as $atrz)
                                    <option value="{{ $atrz->authorization_id }}" {{(!empty($tempPo) && $tempPo->po_maker == $atrz->authorization_id) ? 'selected' : ''}}>{{ $atrz->authorization_name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="inputNote">Yang Menyetujui :</label>
                            <select name="purchase_po_yang_menyetujui" form="purchaseOrderSaveForm" id="purchase_po_yang_menyetujui">
                                <option value="">Pilih</option>
                                @foreach ($authorization as $atrz)
                                    <option value="{{ $atrz->authorization_id }}" {{(!empty($tempPo) && $tempPo->po_approver == $atrz->authorization_id) ? 'selected' : ''}}>{{ $atrz->authorization_name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card float-right total-info">
                <div class="card-body">
                    <table>
                        <tr>
                            <td class="text-right pl-5">Sub Total :</td>
                            <td class="text-right pl-5" id="purchaseOrderSubTotalHarga">-</td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5">Discount :</td>
                            <td class="text-right pl-5">
                                <input type="text" placeholder="" id="purchaseOrderDiscount" name="purchase_po_discount"
                                    class="dm-input" value="{{ $tempPo->discount ?? '' }}"
                                    form="purchaseOrderSaveForm">
                                <select id="purchaseOrderDiscountType" class="dm-input-dropdown"
                                    name="purchase_po_discount_type" form="purchaseOrderSaveForm">
                                    <option value=""
                                        {{(!empty($tempPo) && $tempPo->type == '') ? 'selected' : ''}}>
                                        -</option>
                                    <option value="%"
                                        {{(!empty($tempPo) && $tempPo->type == '%') ? 'selected' : ''}}>
                                        %</option>
                                    <option value="$"
                                        {{(!empty($tempPo) && $tempPo->type == '$') ? 'selected' : ''}}>
                                        Rp.</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right pl-5">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="purchaseCreatePPN" name="ppn" form="purchaseOrderSaveForm" {{(!empty($tempPo) && $tempPo->ppn == 10) ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="purchaseCreatePPN">PPN 10%</label>
                                 </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right pl-5 h4" style="padding: 1rem 0">Total :</td>
                            <td class="text-right pl-5 h4" style="padding: 1rem 0" id="purchaseOrderTotalHarga">-</td>
                        </tr>
                    </table>
                    <form action="{{ url('/purchaseorders/new') }}" enctype="multipart/form-data" method="POST"
                        id="purchaseOrderSaveForm">
                        @csrf
                        <button class="float-right my-2 mx-1 btn btn-primary">Save</button>
                    </form>
                    <a href="{{ url('/purchaseorders/temp/reset') }}"><button
                            class="float-right my-2 btn btn-danger">Reset</button></a>

                </div>
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
            <form action="{{ url('purchaseorders/temp/detail/edit') }}" method="POST">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="product_id" id="editDetailProductId" hidden>
                        <div class="col-6">
                            <label for="discount">Qty</label>
                            <input type="number" class="form-control" name="qty" id="editDetailQty">
                        </div>
                        <div class="col-6">
                            <label for="discount">Unit Price</label>
                            <input type="number" class="form-control" name="unit_price" id="editDetailUnitPrice">
                        </div>
                        <div class="col-6">
                            <label for="discount">Unit</label>
                            <select class="form-control" name="unit" id="editDetailUnit">
                                <option value="">Pilih Unit</option>
                                <option value="btl">Btl</option>
                                <option value="ltr">Ltr</option>
                                <option value="pcs">Pcs</option>
                                <option value="unit">Unit</option>
                                <option value="set">Set</option>
                                <option value="lot">Lot</option>
                                <option value="buah">Buah</option>
                                <option value="mtr">Mtr</option>
                                <option value="roll">Roll</option>

                            </select>
                        </div>
                        <div class="col-6">
                            <label for="discount">Discount</label>
                            <input type="number" class="form-control" name="discount" id="editDetailDiscount" value="">
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

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="poAddProductModal" tabindex="-1" role="dialog"
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
                    <input type="text" class="form-control" id="inputPoSearchProductCreate"
                        aria-describedby="emailHelp" placeholder="Search Product Here">
                    <br>
                    <div class="spinner-border text-primary d-none" id="po-search-loading-bar" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="productData">
                    <table id="salesPoSearchProductResultCreate" class="table table-striped table-bordered mt-4"
                        role="grid" aria-describedby="user-list-page-info">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Nama Product</th>
                                <th>Harga Jual</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="poSearchProductResultTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('/assets/js/ajax/purchase-order.js') }}"></script>
@endsection
