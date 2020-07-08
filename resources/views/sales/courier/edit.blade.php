@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{ $pageTitle ?? 'Untitled Page' }}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="form-group">
                        <div class="add-img-user profile-img-edit">
                            <img class="profile-pic img-fluid wh-150p"
                                src=" {{ url('assets/images/user/1.jpg') }}" alt="profile-pic">
                            <div class="p-image">
                                <a href="javascript:void();" class="upload-button btn iq-bg-primary">File Upload</a>
                                <input class="file-upload" name="profile" type="file" accept="image/*">
                            </div>
                        </div>
                        <div class="img-extension mt-3">
                            <div class="d-inline-block align-items-center">
                                <span>Only</span>
                                <a href="javascript:void();">.jpg</a>
                                <a href="javascript:void();">.png</a>
                                <a href="javascript:void();">.jpeg</a>
                                <span>allowed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">New Courier Information</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @if($message = Session::get('Error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ url('/couriers/'.$courier->courier_id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Courier Name</label>
                                    <input type="text" name="courier-name" class="form-control" placeholder="Enter username" value="{{ $courier->courier_name }}"
                                        required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Contact</label>
                                    <input type="text" name="courier-contact" class="form-control"
                                        placeholder="Enter Contact" value="{{ $courier->courier_contact }}" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Address</label>
                                    <input type="text" name="courier-address" class="form-control"
                                        placeholder="Enter Contact" value="{{ $courier->courier_address }}" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
