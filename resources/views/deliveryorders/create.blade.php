@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">New Delivery Order</h4>
        </div>
        <div>
            <form action="{{ url('/deliveryorders/temp/reset') }}" class="d-inline-block"
                method="POST">
                @method('delete')
                @csrf
                <button type="submit" data-toggle="tooltip" data-placement="top" id="save-purchase-order"
                    class="btn btn-primary">Reset</button>
            </form>
            <form action="{{ url('/deliveryorders/new') }}" class="d-inline-block" method="POST">
                @csrf
                <button type="submit" data-toggle="tooltip" data-placement="top" id="save-purchase-order"
                    class="btn btn-primary">Save</button>
            
        </div>
    </div>
    <div class="iq-card-body">
        <div class="row">
            <div class="col-8">
                <table>
                    <tr>
                        <td>Delivery Order ID</td>
                        <td class="pl-4">
                            :
                            <span>XXXX/SURATJALAN/DM/</span>
                            <select name="inputSalesInvoiceInvoiceIdCreateRomawi" form="salesInvoiceFormSave"
                                id="inputDoCreateRomawi" form="salesPurchaseOrderTempSave">
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
                            <select name="inputSalesInvoiceInvoiceIdCreateYear" id="inputDoCreateYear"
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
                        <input type="text" hidden value="{{ app('request')->input('po_id') }}" id="inputDeliveryPoId">
                    </tr>
                    <tr>
                        <td>Delivery Order Num</td>
                        <td class="pl-4">
                            : <input type="text" name="do-num" id="inputDeliveryDoNum"
                            value="{{ $tempDo->do_num ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td>PO ID</td>
                        <td class="pl-4">
                            :
                            <span>{{ str_pad($po->po_id, 4, '0', STR_PAD_LEFT).$po->po_id_format }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sender</td>
                        <td class="pl-4"> :
                            <input type="text" name="do-sender" id="inputDeliveryDoSender"
                            value="{{ $tempDo->do_sender ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Receiver</td>
                        <td class="pl-4"> :
                            <input type="text" name="do-receiver" id="inputDeliveryDoReceiver"
                            value="{{ $tempDo->do_receiver ?? '' }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Deliveryman</td>
                        <td class="pl-4"> :
                            <input type="text" name="do-deliveryman" id="inputDeliveryDoDeliveryman"
                            value="{{ $tempDo->do_deliveryman ?? '' }}">
                        </td>
                    </tr>

                </table>
            </div>
            <div class="col-4">
                <table>
                    <tr>
                        <td>Date</td>
                        <td class="pl-4">
                            : <input type="date" id="inputDeliveryDoDate" name="do-date"
                            value="{{ !empty($tempDo) ? date('Y-m-d', strtotime($tempDo->do_date)) : '' }}">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="inputNote">Note :</label>
                <textarea class="form-control" name="do-note" id="inputDeliveryDoNote"
                    rows="2">{{ $tempDo->do_note ?? '' }}</textarea>
            </div>
        </div>
        </form>


        <div class="d-flex float-right my-2">
            <button class="btn btn-primary" id="deliveryDoAddProduct">
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
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tempDetailDo as $tddo)
                    <tr>
                        <td>{{ $tddo->product_id }}</td>
                        <td>{{ $tddo->product_name }}</td>
                        <td>{{ $tddo->qty }}</td>
                        <td>{{ $tddo->note }}</td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                                <button class="btn btn-warning delivery-detail-edit" data-toggle="modal"
                                    data-target="#editdetail" data-placement="top" title="" data-original-title="Edit"
                                    data-id="product-detail-update" data-content=""
                                    dm-data="{{ $tddo->product_id }}">Edit</button>

                                <form
                                    action="{{ url('/deliveryorders/detail/'.$tddo->product_id) }}"
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
@section('script')
<script src="{{ asset('/assets/js/ajax/purchase/delivery-order.js') }}"></script>
@endsection
