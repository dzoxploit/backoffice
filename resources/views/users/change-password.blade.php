@extends('layouts.home-template')
@section('content')
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title">Change Password</h4>
        </div>
    </div>
    <div class="iq-card-body">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="cpass">Current Password:</label>
                <input type="Password" class="form-control" name="current_password" id="cpass" value="" >
                @error('current_password')
                <small class="form-text text-muted text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="npass">New Password:</label>
                <input type="Password" class="form-control" name="new_password" id="npass" value="" >
                @error('new_password')
                <small class="form-text text-muted text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2">Change</button>
            <button type="reset" class="btn iq-bg-danger">Cancel</button>
        </form>
    </div>
</div>
@endsection
