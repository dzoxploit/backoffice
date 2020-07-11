@extends('layouts.home-template')

@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">{{ $pageTitle }}</h4>
        </div>
        <div>
            <form
                action="{{ url('/sales/purchaseorders/'.$bargain ?? ''->bargain_id ?? '') }}"
                class="d-inline-block" method="POST">
                @method('delete')
                @csrf
                <button type="submit" data-toggle="tooltip" data-placement="top" id="save-purchase-order"
                    class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    <div class="iq-card-body">

        <div class="row">
            <div class="col-8">
                <div class="form-group row">
                    <label for="inputPoId" class="col-2 col-form-label">Bargain ID :</label>
                    <div class="col">
                        {{ $bargain->bargain_id ?? '' }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPoId" class="col-2 col-form-label">Nama Customer :</label>
                    <div class="col">
                        {{ $bargain->customer_id ?? '' }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPoId" class="col-2 col-form-label">Dibuat oleh :</label>
                    <div class="col">
                        {{ $bargain->created_by ?? '' }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPoId" class="col-2 col-form-label">Diupdate oleh :</label>
                    <div class="col">
                        {{ $bargain->updated_by ?? '' }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPoId" class="col-2 col-form-label">Discount :</label>
                    <div class="col">
                        {{ $bargain->discount.$bargain->discount_type ?? '' }}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group row">
                    <label for="inputDueDate" class="col-2 col-form-label">Expr :</label>
                    {{ !empty($bargain ?? '') ? date('Y-m-d', strtotime($bargain ?? ''->expr)) : '' }}
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col">
            <label for="inputNote">Note :</label>
            <textarea class="form-control" name="do-note" id="inputDeliveryDoNote" disabled readonly
                rows="2">{{ $bargain->bargain_note ?? '' }}</textarea>
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
                <th>Harga Penawaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detailBargain as $dbar)
                <tr>
                    <td>{{ $dbar->product_id }}</td>
                    <td>{{ $dbar->product_name }}</td>
                    <td>{{ $dbar->qty }}</td>
                    <td>{{ $dbar->unit_price }}</td>
                    <td>{{ $dbar->bargain_price }}</td>
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
