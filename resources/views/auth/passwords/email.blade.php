@extends('auth.layout')
@section('title', 'Reset password')
@section('content')
<div class="hide-border">
   <div class="vertical-align-wrap">
      <div class="vertical-align-middle auth-main">
         <div class="auth-box">
            <div class="top"><img src="{{asset('storage/'.homepage('company_logo'))}}"
                  alt="{{ settings('company_name') }}" style="height: 40px; margin: 10px;"></div>
            <div class="card">
               <div class="header">
                  <p class="lead">{{ __('Reset Password') }}</p>
               </div>
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <form method="POST" action="{{ route('password.email') }}">
                  @csrf
                  <div class="body">
                     <div class="form-auth-small" action="#">
                        <div class="form-group"><label class="control-label sr-only">{{ __('E-Mail Address')
                              }}</label><input name="email" class="form-control" id="signin-email" placeholder="Email"
                              type="email" value="{{ old('email') }}" required>
                           @error('email')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">{{ __('Send Password Reset Link')
                           }}</button>
                        <div class="bottom"><span class="helper-text m-b-10"><i
                                 class="fa fa-lock"></i></span><span>Don't have an account? <a
                                 href="{{route('register')}}">Register</a></span></div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection