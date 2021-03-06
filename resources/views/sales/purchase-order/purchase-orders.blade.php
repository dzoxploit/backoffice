@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Purchase Order</h4>
                    </div>
                    <div>
                        <a type="button" href="{{ url('/sales/purchaseorders/new') }}" class="btn btn-primary">
                            Add New PO
                        </a>
                    </div>
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

                    @if($message = Session::get('Error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                                    <th>PO ID</th>
                                    <th>Customer PO</th>
                                    <th>Nomor Penawaran</th>
                                    <th>Customer</th>
                                    <th>Discount</th>
                                    <th>Tgl Entri</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseOrderCustomers as $poc)
                                    <tr>
                                        <td>{{ str_pad($poc->po_id, 4, '0', STR_PAD_LEFT).$poc->po_id_format }}</td>
                                        <td>{{ $poc->po_num }}</td>
                                        <td>{{ $poc->bargain_id }}</td>
                                        <td>{{ $poc->fullname }}</td>
                                        <td>{{ $poc->po_discount.$poc->po_discount_type }}</td>
                                        <td>{{ $poc->created_at }}</td>
                                        <td class="text-center">
                                            <div class="flex align-items-center">
                                                <a type="button" class="btn btn-info" data-placement="top"
                                                    data-toggle="tooltip" title="" data-original-title="Edit"
                                                    href="{{ '/sales/purchaseorders/'.$poc->po_id }}">Detail</a>

                                                {{-- <a type="button" class="btn btn-warning" data-placement="top" data-toggle="tooltip" title=""
                                                data-original-title="Edit"
                                                href="{{ 'users/'.$poc->id_user.'/edit' }}">Update</a>
                                                --}}

                                                <form
                                                    action="{{ url('/sales/purchaseorders/'.$poc->po_id) }}"
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

<!-- Modal -->
<div class="modal fade" id="salesPoOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Choose One</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary">Tambah Baru</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#salesPoOpenBargain" data-dismiss="modal">Buka penawaran ?</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
