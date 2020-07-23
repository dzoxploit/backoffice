@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Daftar Otorisasi</h4>
                    </div>
                    <a href="{{ url('/authorizations/new') }}" class="btn btn-primary">
                        Tambahkan Otoritas
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
                                    <th>Nama</th>
                                    <th>Authorization Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($authorizations as $author)
                                    <tr>
                                        <td class="text-center"><img class="rounded-circle img-fluid avatar-40"
                                                src="{{ url('assets/images/user/01.jpg') }}"
                                                alt="profile"></td>
                                        <td>{{ $author->authorization_name }}</td>
                                        @if ($author->authorization_type == 0)
                                            <td><span class="text-danger">Yang Menyetujui</span></td>
                                        @elseif ($author->authorization_type == 1)
                                            <td><span class="text-primary">Yang Membuat</span></td>
                                        @endif
                                       
                                        <td class="text-center">
                                            <div class="flex align-items-center">
                                                <a type="button" class="btn btn-warning" data-placement="top" data-toggle="tooltip" title=""
                                                data-original-title="Edit"
                                                href="{{ '/authorizations/'.$author->authorization_id.'/edit' }}">Edit</a>

                                                <form action="{{ url('/authorizations/'.$author->authorization_id) }}"
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
                        {{-- {{ $users->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
