@extends('auth.layout')
@section('title', 'Login')
@section('content')
<div class="hide-border">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle auth-main">
            <div class="auth-box">
                <div class="top"><img src="{{asset('storage/'.homepage('company_logo'))}}"
                        alt="{{ settings('company_name') }}" style="height: 40px; margin: 10px;"></div>
                <div class="card">
                    <div class="header">
                        <p class="lead">Login to your account</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="body">
                            <div class="form-auth-small" action="#">
                                <div class="form-group"><label class="control-label sr-only">Email</label><input
                                        name="email" class="form-control" id="signin-email" placeholder="Email"
                                        type="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group"><label class="control-label sr-only">Password</label><input
                                        name="password" class="form-control" id="signin-password" placeholder="Password"
                                        type="password"></div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <!-- <div class="form-group clearfix"><label
                                    class="fancy-checkbox element-left"><input
                                        type="checkbox"><span>Remember me</span></label></div> -->
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                <div class="bottom"><span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a
                                            href="{{route('password.request')}}">Forgot
                                            password?</a></span><span>Don't have an account? <a
                                            href="{{route('register')}}">Register</a></span></div>
                                <div class="separator">Or Login With</div>
                                <div class="text-center">
                                    <a class="btn btn-link pl-0 social-link" href="{{ route('outlook_login')}}"
                                        title="Login With Facebook">
                                        <!-- {{ __("Login With Facebook") }} -->
                                        <span
                                            class="circle d-flex justify-content-center align-items-center border-primary">
                                            <i class="fab fa-facebook-f text-primary"></i>
                                        </span>
                                    </a>
                                    <a class="btn btn-link social-link" href="{{ route('google_login')}}"
                                        title="Login With Google">
                                        <!-- {{ __("Login With Google") }} -->
                                        <span
                                            class="circle d-flex justify-content-center align-items-center border-danger">
                                            <i class="fab fa-google text-danger"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection