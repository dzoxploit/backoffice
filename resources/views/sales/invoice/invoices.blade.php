@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{ $cardName }}</h4>
                    </div>
                    <a href="{{ url('/sales/invoices/po') }}" class="btn btn-primary">
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
                        <div class="d-flex float-right my-2">
                            <a href="{{ url('/sales/invoices') }}"><button class="btn btn-primary mr-2" id="search-product">
                                Invoice List
                            </button>
                            </a>
                            <a href="{{ url('/sales/invoices/po') }}"><button class="btn btn-primary" id="search-product">
                                PO List
                            </button></a>
                        </div>
                        @if (empty($invoices))
                            @yield('polist')
                        @else
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                            aria-describedby="user-list-page-info">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Tgl. Dibuat</th>
                                    <th>Bill To</th>
                                    <th>Terms</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoices as $inv)
                                    <tr>
                                        <td>{{ str_pad($inv->invoice_id, 4, '0', STR_PAD_LEFT).$inv->invoice_id_format }}</td>
                                        <td>{{ date('Y/m/d', strtotime($inv->created_at)) }}</td>
                                        <td>{{ $inv->bill_to }}</td>
                                        <td>{{ $inv->terms.' Hari' }}</td>
                                        <td>{{ date('Y/m/d', strtotime($inv->due_date)) }}</td>
                                        @if ($inv->paid_at == null)
                                            <td><b>Belum Bayar</b></td>
                                        @else
                                            <td><b>Sudah Bayar</b></td>
                                        @endif
                                        
                                        <td class="text-center">
                                            <div class="flex align-items-center">
                                                <a href="{{ url('/sales/invoices/'.$inv->invoice_id) }}"><button type="button" class="btn btn-info">Detail</button></a>

                                                <form action="{{ url('invoices/'.$inv->invoice_id) }}"
                                                    method="post" class="d-inline-block">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Delete">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                    </table>        
                        @endif
                    </div>
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
@endsection
@section('script')
<script src="{{ asset('/assets/js/ajax/sales/invoice.js') }}"></script>
@endsection
