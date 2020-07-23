@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Daftar Vendor</h4>
                    </div>
                    <a href="{{ url('suppliers/new') }}" class="btn btn-primary">
                        Tambah Vendor Baru
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
                                    <th>Profile</th>
                                    <th>ID</th>
                                    <th>Nama Vendor</th>
                                    <th>Nama Kontak</th>
                                    <th>Email Kontak</th>
                                    <th>No.Telp Kontak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $sup)
                                    <tr>
                                        <td class="text-center"><img class="rounded-circle img-fluid avatar-40"
                                                src="{{ url('assets/images/user/01.jpg') }}"
                                                alt="profile"></td>
                                        <td>{{ $sup->sup_id }}</td>
                                        <td>{{ $sup->sup_name }}</td>
                                        <td>{{ $sup->cp_name }}</td>
                                        <td>{{ $sup->cp_email }}</td>
                                        <td>{{ $sup->cp_telp }}</td>
                                        <td class="text-center">
                                            <div class="flex align-items-center">
                                                <a type="button" class="btn btn-primary" data-placement="top" data-toggle="tooltip" title=""
                                                data-original-title="Edit"
                                                href="{{ 'suppliers/'.$sup->sup_id }}">Detail</a>

                                                <a type="button" class="btn btn-warning" data-placement="top" data-toggle="tooltip" title=""
                                                data-original-title="Edit"
                                                href="{{ 'suppliers/'.$sup->sup_id.'/edit' }}">Ubah</a>

                                                <form action="{{ url('suppliers/'.$sup->sup_id) }}"
                                                    method="post" class="d-inline-block">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Delete">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-between mt-3">
                        {{ $suppliers->links('partials.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
