@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Tambah Vendor Baru</h4>
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
                        <h4 class="card-title">Data Vendor Baru</h4>
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
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Pastikan Untuk Mengisi data dengan Benar!!</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <h5 class="mb-3"><b>Data Vendor</b></h5>
                    <div class="new-user-info">
                        <form action="{{ url()->current() }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Nama Vendor</label>
                                    <input type="text" name="sup_name" class="form-control" placeholder="Masukan nama vendor"
                                        required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Email Vendor</label>
                                    <input type="email" name="sup_email" class="form-control" placeholder="Masukan Email Vendor"
                                        required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Alamat</label>
                                    <input type="text" name="sup_address" class="form-control" placeholder="Masukan Alamat Vendor"
                                        required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Alamat 2</label>
                                    <input type="text" name="sup_address2" class="form-control"
                                        placeholder="Masukan Alamat Alternatif Vendor" />
                                    <small class="help-block">*Kosongkan jika tidak ada</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Deskripsi</label>
                                <textarea name="sup_desc" id="" cols="30" rows="2" class="form-control" placeholder="Masukan Deskripsi Vendor"></textarea>
                                <small class="help-block">*Kosongkan jika tidak ada</small>
                            </div>

                            <hr>
                            <h5 class="mb-3"><b>Kontak</b></h5>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Nama</label>
                                    <input type="text" name="cp_name" class="form-control"
                                        placeholder="Masukan Nama" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">No. Telp</label>
                                    <input type="text" name="cp_telp" class="form-control"
                                        placeholder="Masukan No Telp" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">Email</label>
                                    <input type="email" name="cp_email" class="form-control"
                                        placeholder="Masukan Email" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-3"><b>Akun Bank</b></h5>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="no-rek-giro" name="no-rek-giro" class="form-control-label">No. Rekening</label>
                                    <input type="text" name="sup_bank_rekening" class="form-control"
                                        placeholder="Masukan Nomor Rekening" id="no-rek-giro" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="no-rek-giro" name="password" class="form-control-label">Nama Bank</label>
                                    <input type="text" name="sup_bank_name" class="form-control"
                                        placeholder="Masukan Nama Bank" id="no-rek-giro" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="no-rek-giro" name="password" class="form-control-label">Cabang Bank</label>
                                    <input type="text" name="sup_bank_cabang" class="form-control"
                                        placeholder="Masukan Cabang Bank" id="no-rek-giro" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="no-rek-giro" name="password" class="form-control-label">Atas Nama</label>
                                    <input type="text" name="sup_bank_an" class="form-control"
                                        placeholder="Masukan Atas Nama" id="no-rek-giro" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-3"><b>Data Lainnya</b></h5>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="no-rek-giro" name="password" class="form-control-label">NPWP</label>
                                    <input type="text" name="sup_npwp" class="form-control"
                                        placeholder="Masukan NPWP" id="no-rek-giro" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
