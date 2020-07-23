@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Tambah Otorisasi Baru</h4>
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
                        <h4 class="card-title">Informasi Otorisasi Baru</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ url('/authorizations/'.$authorization->authorization_id) }}" method="POST">
                            @method('patch')
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label name="name" class="form-control-label">Nama</label>
                                    <input type="text" name="authorization_name" class="form-control" placeholder="Enter username" value="{{ $authorization->authorization_name ?? '' }}"
                                        required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="" class="form-control-label">Tipe Otorisasi</label>
                                    <select name="authorization_type" id="" class="form-control">
                                        <option value="">Pilih Wewenang</option>
                                        <option value="0" {{ $authorization->authorization_type == 0 ? 'selected' : '' }}>Yang Menyetujui</option>
                                        <option value="1" {{ $authorization->authorization_type == 1 ? 'selected' : '' }}>Yang Membuat</option>
                                    </select>

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
