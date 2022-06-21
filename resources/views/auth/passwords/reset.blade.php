@extends('auth.layout')
@section('title', 'Change Password')
@section('content')
<div class="hide-border">
    <div class="vertical-align-wrap">
        <div class="vertical-align-middle auth-main">
            <div class="auth-box">
                <div class="top"><img src="{{asset('storage/'.homepage('company_logo'))}}"
                        alt="{{ settings('company_name') }}" style="height: 40px; margin: 10px;"></div>
                <div class="card">
                    <div class="header">
                        <p class="lead">{{ __('Change Password') }}</p>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="body">
                            <div class="form-auth-small" action="#">
                                <div class="form-group"><label class="control-label sr-only">{{ __('E-Mail Address')
                                        }}</label><input name="email" class="form-control" id="signin-email"
                                        placeholder="Email" type="email" value="{{ $email ?? old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group"><label class="control-label sr-only">{{ __('Password')
                                        }}</label><input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group"><label class="control-label sr-only">{{ __('Confirm Password')
                                        }}</label><input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" placeholder="Confirm Password" required
                                        autocomplete="new-password">

                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Reset Password')
                                    }}</button>
                                <div class="bottom"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection