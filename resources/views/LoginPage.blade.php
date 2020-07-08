@extends('layouts.TemplatePage')

@section('content')
<!-- Sign in Start -->
<section class="sign-in-page">
    <div class="container p-0">
        <div class="row no-gutters">
            <div class="col-sm-12 align-self-center">
                <div class="sign-in-from bg-white">
                    <h1 class="mb-0">Sign in</h1>
                    <p>Enter your Username and Password to access adin panel.</p>
                    @if($message = Session::get('Success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if($message = Session::get('Error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form class="mt-4" action="{{ url('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputUsername">Username</label>
                            <input type="text" class="form-control mb-0" id="inputUsername" name="username"
                                placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control mb-0" name="password" id="inputPassword"
                                placeholder="Password">
                        </div>
                        <div class="d-inline-block w-100">
                            {{-- <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Remember Me</label>
                            </div> --}}
                            <button type="submit" class="btn btn-primary float-right">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sign in END -->
@endsection
