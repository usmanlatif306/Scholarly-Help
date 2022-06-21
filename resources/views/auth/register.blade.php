@extends('auth.layout')
@section('title', 'Register')
@section('content')
<div class="hide-border">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle auth-main">
            <div class="auth-box">
                <div class="top"><img src="{{asset('storage/'.homepage('company_logo'))}}"
                        alt="{{ settings('company_name') }}" style="height: 40px; margin: 10px;"></div>
                <div class="card">
                    <div class="header">
                        <p class="lead">Create Account</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="user_token" value="{{$data ? $data['user_token']:''}}">
                        <div class="body">
                            <div class="form-auth-small" action="#">
                                <div class="form-group">
                                    <!-- <label
                                class="control-label sr-only">{{ __('First Name') }}</label> -->
                                    <input id="first_name" type="text" class="form-control" placeholder="First Name"
                                        name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <!-- <label for="last_name">{{ __('Last Name') }}</label> -->
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" required autocomplete="last_name"
                                        placeholder="Last Name">
                                    @error('last_name')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group @error('email') is-invalid @enderror">
                                    <!-- <label>{{ __('E-Mail Address') }}</label> -->
                                    <div class="input-group input-group-merge">

                                        <input placeholder="name@example.com" id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ session()->get( 'email' ) ?? '' }}" {{ session()->get( 'readonly'
                                        ) ?? ''}} required
                                        autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-4 @error('password') is-invalid @enderror">
                                    <!-- <label>{{ __('Password') }}</label> -->
                                    <div class="input-group input-group-merge">

                                        <input id="password" type="password" class="form-control" name="password"
                                            required autocomplete="new-password" placeholder="******">
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <!-- <label>{{ __('Confirm Password') }}</label> -->
                                    <div class="input-group input-group-merge">

                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="******">
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- <div class="form-group clearfix"><label
                                    class="fancy-checkbox element-left"><input
                                        type="checkbox"><span>Remember me</span></label></div> -->
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                                <div class="bottom"><span>Don't have an account? <a
                                            href="{{route('login')}}">Login</a></span></div>
                                <div class="separator">Or Signup With</div>
                                <div class="text-center">
                                    <a class="btn btn-link pl-0 social-link" href="{{ route('facebook_login')}}"
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