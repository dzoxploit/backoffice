@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{ $pageTitle ?? 'Untitle Page' }}</h4>
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
                        <h4 class="card-title">Informasi Pelanggan Baru</h4>
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
                                    <label class="form-control-label">Nama Pelanggan</label>
                                    <input type="text" name="customer-name" class="form-control"
                                        placeholder="Enter username" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Alamat Kantor</label>
                                    <input type="text" name="customer-address" class="form-control"
                                        placeholder="Enter Address" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">No. Telp</label>
                                    <input type="text" name="customer-no-telp" class="form-control"
                                        placeholder="Enter No telp" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Perusahaan</label>
                                    <input type="text" name="customer-company" class="form-control"
                                        placeholder="Enter Perusahaan" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Departemen</label>
                                    <input type="text" name="customer-department" class="form-control"
                                        placeholder="Enter Departemen" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Alamat Gudang</label>
                                <input type="text" name="warehouse-address" class="form-control"
                                    placeholder="Masukan Alamat Gudang" required />
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
