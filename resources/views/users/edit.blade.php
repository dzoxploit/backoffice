@extends('layouts.home-template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Edit User</h4>
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
                        <h4 class="card-title">Change User Information</h4>
                    </div>
                    <div>
                        {{-- <a href="{{ url('/users/'. $user->id_user .'/changepassword') }}"><button class="btn btn-primary">Change Password</button></a> --}}
                    </div>
                </div>
                <div class="iq-card-body">
                    @if($message = Session::get('Error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="new-user-info">
                        <form action="{{ url('users/'.$user->id_user) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label name="name" class="form-control-label">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter username"
                                        value="{{ $user->username }}" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label name="name" class="form-control-label">Fullname</label>
                                    <input type="text" name="fullname" class="form-control" placeholder="Enter Fullname" value="{{ $user->fullname }}" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label name="email" class="form-control-label">Contact Number</label>
                                    <input type="text" name="contact" class="form-control" placeholder="Enter contact no" value="{{ $user->contact }}" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label name="role" class="form-control-label">Role</label>
                                    <select name="role" id="role" class="form-control select2js">
                                        <option value="NULL">Select Role</option> 
                                        @foreach ($roles as $rl)
                                            <option value="{{ $rl->role_id }}" {{ $rl->role_id == $user->role_id ? 'selected' : '' }} >{{ $rl->role_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            {{-- <hr> --}}
                            {{-- <h5 class="mb-3">Security</h5>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label name="password" id="password" class="form-control-label">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Enter password" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label name="password_confirmation" class="form-control-label">Confirm
                                        Password</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Enter confirm password" data-match='#password'
                                        data-match-error="password does not match" required />
                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-md btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
