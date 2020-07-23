@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Daftar Surat Pesanan</h4>
                    </div>
                    <a href="{{ url('/purchaseorders/new') }}" class="btn btn-primary">
                        Tambah Surat Pesanan Baru
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
                                    <th>No. Surat Pesanan</th>
                                    <th>Vendor</th>
                                    <th>Tgl. Surat Pesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseOrder as $po)
                                    <tr>
                                        <td>{{ $po->po_id_format.str_pad($po->po_id, 4, '0', STR_PAD_LEFT)}}</td>
                                        <td>{{ $po->sup_name }}</td>
                                        <td>{{ $po->date }}</td>
                                        <td class="text-center">
                                            <div class="flex align-items-center">
                                                <a type="button" class="btn btn-info" data-placement="top" data-toggle="tooltip" title=""
                                                data-original-title="Edit"
                                                href="{{ '/purchaseorders/'.$po->po_id }}">Detail</a>

                                                {{-- <a type="button" class="btn btn-warning" data-placement="top" data-toggle="tooltip" title=""
                                                data-original-title="Edit"
                                                href="{{ 'users/'.$po->id_user.'/edit' }}">Update</a> --}}

                                                <form action="{{ url('/purchaseorders/'.$po->po_id) }}"
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
                        {{ $purchaseOrder->links('partials.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
