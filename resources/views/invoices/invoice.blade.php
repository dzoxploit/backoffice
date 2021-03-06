@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Invoice</h4>
                    </div>
                    <a href="{{ url('invoices/new') }}" class="btn btn-primary">
                        Add New Invoice
                    </a>
                </div>
                <div class="iq-card-body">
                    @if($message = Session::get('Success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <div class="row justify-content-between">
                            <div class="col-sm-12 col-md-6">
                                <div id="user_list_datatable_info" class="dataTables_filter">
                                    <form class="mr-3 position-relative">
                                        <div class="form-group mb-0">
                                            <input type="search" class="form-control" id="exampleInputSearch"
                                                placeholder="Search" aria-controls="user-list-table">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">

                            </div>
                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                            aria-describedby="user-list-page-info">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>No. Invoice</th>
                                    <th>Invoice Date</th>
                                    <th>PO ID</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $inv)
                                    <tr>
                                        <td>{{ $inv->invoice_id }}</td>
                                        <td>{{ $inv->no_invoice }}</td>
                                        <td>{{ date('Y/m/d', strtotime($inv->created_at))}}</td>
                                        <td>{{ str_pad($inv->po_id, 4, '0', STR_PAD_LEFT).$inv->po_id_format }}</td>
                                        <td>{{ date('Y/m/d', strtotime($inv->due_date)) }}</td>
                                        <td class="text-center">
                                            <div class="flex align-items-center">
                                                <a href="{{ url('/invoices/'.$inv->invoice_id) }}"><button type="button" class="btn btn-info">Detail</button></a>
                                                <form action="{{ url('invoices/'.$inv->invoice_id) }}"
                                                    method="post" class="d-inline-block">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Delete">Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-primary" id="validasi_pembayaran" data-toggle="modal" value="{{$inv->invoice_id}}" data-target="#exampleModal">
                                                    Validasi Pembayaran
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <!--Awal Modal Validasi Pembayaran-->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Validasi Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div>
                    <form action="{{ url('/invoices/bukti-bayar') }}" enctype="multipart/form-data" class="d-inline-block" method="POST">
                        @csrf
                     </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="invoiceId" class="col-4 col-form-label">Invoice ID :</label>
                                    <div class="col">
                                        <input class="form-control" type="text" name="invoice_id" id="invoice_id_data"/>
                                    </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="paid" class="col-4 col-form-label">Jumlah Yang Dibayar :</label>
                                    <div class="col">
                                        <input class="form-control" type="text" name="paid"/>
                                    </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="paid" class="col-4 col-form-label">Jumlah Yang Dibayar :</label>
                                    <div class="col">
                                        <input class="form-control" type="date" name="paid_date"/>
                                    </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="paidProof" class="col-4 col-form-label">Bukti Pembayaran :</label>
                                    <div class="col">
                                    <input type="file" name="payment_proof" id="salesPoCustomerAttachment" accept="image/png, image/jpeg">
                                    </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="paymentMethod" class="col-4 col-form-label">Payment Method :</label>
                                    <div class="col">
                                    <input class="form-control" type="text" name="payment_method"/>
                                    </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="note" class="col-4 col-form-label">Note :</label>
                                    <div class="col">
                                    <input class="form-control" type="text" name="note"/>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="float-right my-2 mx-1 btn btn-primary" >Save</button>
                    </form>
                    </div>
                    </div>
                </div>
                </div>
            <!--Akhir Modal-->
                    <div class="row justify-content-between mt-3">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var data_id = document.getElementById("validasi_pembayaran").value;
document.getElementById("invoice_id_data").value = data_id;
</script>
@endsection

