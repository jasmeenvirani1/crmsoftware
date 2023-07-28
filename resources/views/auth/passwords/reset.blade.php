<?php
use Request as Input;
?>

@extends('layouts.app')
@section('content')
<div class="kt-login__container" style="display: block !important;">    
    <div class="kt-login__logo">
        <a href="#">
            <img src="{{url('assets/admin/media/logos/logo-mini-2-md.png')}}">
        </a>
    </div>   

    <div class="kt-login__forgot" style="display: block !important;">
        <div class="kt-login__head">
            <h3 class="kt-login__title">{{ __('Reset Password') }}</h3>            
        </div>         
        {!! Form::open(['route' => 'reset-password','class'=>'kt-form','id'=>'reset_password','name'=>'reset_password','enctype'=>'multipart/form-data','method'=>'post']) !!}  
            @csrf
            @include('errormessage')
            <input id="token" type="hidden" class="form-control @error('token') is-invalid @enderror" name="token" value="{{ $token ?? old('token') }}" required autocomplete="email" autofocus>

            <!-- <div class="input-group">                
                {!! Form::text('email',Input::old('email'), ['class' => 'form-control','id'=>"email",'name'=>'email','placeholder'=>'E-Mail Address']) !!}
            </div> -->

            <div class="input-group">                
                {{ Form::password('password',array('class' => 'form-control','placeholder' => 'New Password','id'=>'password','name'=>'password')) }}
            </div>

            <div class="input-group">                
                {{ Form::password('cnf_password',array('class' => 'form-control','placeholder' => 'Confirm Password','id'=>'cnf_password','name'=>'cnf_password')) }}
            </div>

            <div class="kt-login__actions">
                <button id="kt_login_forgot_submit1" type="submit" class="btn btn-pill kt-login__btn-primary">Save</button>&nbsp;&nbsp;
                <button type="button" id="kt_login_forgot_cancel1" class="btn btn-pill kt-login__btn-secondary">Cancel</button>
            </div>
        {!! Form::close() !!}
    </div>   

</div>
@endsection


@section('script')


<script type="text/javascript">
    
    $( "#kt_login_forgot_cancel1" ).bind("click",function() {
        window.location.href = baseUrl;
    });

    $(document).ready(function () {
        $('#reset_password').validate({
            rules: {
                email: {
                    required: true,                    
                    email:true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                cnf_password: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }
            }
        });
    });

</script>
@endsection

