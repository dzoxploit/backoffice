@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Add New Supplier</h4>
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
                        <h4 class="card-title">New Supplier Information</h4>
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
                        <form action="{{ url()->current() }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Supplier Name</label>
                                    <input type="text" name="sup_name" class="form-control" placeholder="Enter username"
                                        required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Address</label>
                                    <input type="text" name="sup_address" class="form-control" placeholder="Enter Address"
                                        required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Address 2</label>
                                    <input type="text" name="sup_address2" class="form-control"
                                        placeholder="Enter Address 2" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Contact</label>
                                    <input type="text" name="sup_cp" class="form-control"
                                        placeholder="Enter Contact" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Contact 2</label>
                                    <input type="text" name="sup_cp2" class="form-control"
                                        placeholder="Enter Contact 2" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>


                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Description</label>
                                <textarea name="sup_desc" id="" cols="30" rows="2" required class="form-control" placeholder="Masukan Deskripsi"></textarea>
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <hr>
                            <h5 class="mb-3">Account</h5>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="no-rek-giro" name="password" class="form-control-label">No. Rekening Giro</label>
                                    <input type="text" name="sup_rek_giro" class="form-control"
                                        placeholder="Enter password" id="no-rek-giro" required />
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
