@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Delivery Orders</h4>
                    </div>
                    <a href="{{ url('deliveryorders/new') }}" class="btn btn-primary">
                        Add New Delivery Order
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
                        <div class="d-flex float-right my-2">
                            <a href="{{ url('/deliveryorders') }}"><button class="btn btn-primary mr-2" id="search-product">
                                Delivery Order List
                            </button>
                            </a>
                            <a href="{{ url('/deliveryorders/po') }}"><button class="btn btn-primary" id="search-product">
                                PO List
                            </button></a>
                        </div>
                        @if (empty($deliveryOrder))
                            @yield('polist')
                        @else
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid"
                            aria-describedby="user-list-page-info">
                            <thead>
                                <tr>
                                    <th>Delivery ID</th>
                                    <th>Delivery Num.</th>
                                    <th>Purchase Order ID</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deliveryOrder as $do)
                                    <tr>
                                        <td>{{ $do->do_id ?? '' }}</td>
                                        <td>{{ $do->do_num ?? '' }}</td>
                                        <td>{{ $do->po_id ?? '' }}</td>
                                        <td>{{ $do->do_date ?? '' }}</td>
                                        <td class="text-center">
                                            <div class="flex align-items-center">
                                                {{-- <a type="button" class="btn btn-warning" data-placement="top"
                                                data-toggle="tooltip" title="" data-original-title="Edit"
                                                href="{{ 'users//edit' }}">Update</a> --}}

                                                <a type="button" class="btn btn-info" data-placement="top"
                                                    data-toggle="tooltip" title="" data-original-title="Detail"
                                                    href="{{ url('/deliveryorders/'.$do->do_id) }}">Detail</a>

                                                <form
                                                    action="{{ url('deliveryorders/'. $do->do_id ?? '') }}"
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
                        {{ $deliveryOrder->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
