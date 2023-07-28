@extends('layouts.app')

@section('content')

 <div class="kt-login__container">
    <div class="kt-login__logo">
        <a href="#">
            <img src="{{url('assets/admin/media/logos/logo-mini-2-md.png')}}">
        </a>
    </div>
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Sign In</h3>
        </div>
        <form class="kt-form" action="">
            <div class="input-group">
                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            <div class="input-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            </div>
            <div class="row kt-login__extra">
                <div class="col kt-align-right">
                    <a href="{{ route('password.request') }}" id="kt_login_forgot" class="kt-link kt-login__link">Forget Password ?</a>
                </div>
            </div>
            <div class="kt-login__actions">
                <button id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary">Sign In</button>
            </div>
        </form>
    </div>   
</div>
@endsection
