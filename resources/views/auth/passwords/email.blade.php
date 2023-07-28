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
            <h3 class="kt-login__title">Forgotten Password ?</h3>
            <div class="kt-login__desc">Enter your email to reset your password:</div>
        </div>            
            {!! Form::open(['route' => 'resetpasswordemail','class'=>'kt-form','id'=>'forgot_password','name'=>'forgot_password','enctype'=>'multipart/form-data','method'=>'post']) !!}  
                @csrf
                @include('errormessage')
                <div class="input-group">
                    
                {!! Form::text('email',Input::old('email'), ['class' => 'form-control','id'=>"email",'name'=>'email','placeholder'=>'Email','autofocus'=>'true']) !!}

                </div>

                <div class="kt-login__actions">
                    <button id="kt_login_forgot_submit1" type="submit" class="btn btn-pill kt-login__btn-primary">Request</button>&nbsp;&nbsp;
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
        $('#forgot_password').validate({
            rules: {
                email: {
                    required: true,                    
                    email:true
                }
            }
        });
    });

</script>
@endsection
