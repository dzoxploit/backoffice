@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Data Vendor</h4>
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
                        <h4 class="card-title">Detil Data Vendor</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @if($message = Session::get('Error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Pastikan Untuk Mengisi data dengan Benar!!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h5 class="mb-3"><b>Data Vendor</b></h5>
                    <div class="new-user-info">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Nama Vendor :</label>
                                <div>{{ $supplier->sup_name ?? '-'}}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Email Vendor :</label>
                                <div>{{ $supplier->sup_email ?? '-' }}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Alamat :</label>
                                <div>{{ $supplier->sup_address ?? '-'}}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Alamat 2 :</label>
                                <div>{{ $supplier->sup_address2 ?? '-'}}</div> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Deskripsi :</label>
                            <div>{{ $supplier->sup_desc ?? '-' }}</div> 
                        </div>

                        <hr>
                        <h5 class="mb-3"><b>Kontak</b></h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Nama :</label>
                                <div>{{ $supplier->cp_name ?? '-'}}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">No. Telp :</label>
                                <div>{{ $supplier->cp_telp ?? '-'}}</div> 
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Email :</label>
                                <div>{{ $supplier->cp_email ?? '-'}}</div> 
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-3"><b>Akun Bank</b></h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="no-rek-giro" name="no-rek-giro" class="form-control-label">No.
                                    Rekening :</label>
                                <div>{{ $supplier->sup_bank_rekening ?? '-'}}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no-rek-giro" name="password" class="form-control-label">Nama Bank :</label>
                                <div>{{ $supplier->sup_bank_name ?? '-'}}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no-rek-giro" name="password" class="form-control-label">Cabang Bank :</label>
                                <div>{{ $supplier->sup_bank_cabang ?? '-'}}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no-rek-giro" name="password" class="form-control-label">Atas Nama :</label>
                                <div>{{ $supplier->sup_bank_an ?? '-'}}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                        </div>
                        <hr>
                        <h5 class="mb-3"><b>Data Lainnya</b></h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="no-rek-giro" name="password" class="form-control-label">NPWP :</label>
                                <div>{{ $supplier->sup_npwp ?? '-'}}</div> 
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
