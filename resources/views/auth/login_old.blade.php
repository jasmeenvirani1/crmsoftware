<?php

use Request as Input;
?>
@extends('layouts.app')
@section('content')
    <div class="kt-login__container">
        <div class="kt-login__logo">
            <a href="#">
                <!-- <img src="{{ url('assets/admin/media/logos/laxmipharma.png') }}" style="width: 250px;"> -->
            </a>
        </div>

        <div class="kt-login__signin">
            <div class="kt-login__head">
                <h3 class="kt-login__title">Sign In</h3>
            </div>
            <!-- <form method="POST" action="{{ route('login') }}" class="kt-form"> -->
            <form method="POST" action="{{ route('login') }}" accept-charset="UTF-8" class="kt-form" id="login"
                name="login" enctype="multipart/form-data" novalidate="novalidate">
                @csrf
                @include('errormessage')
                <div class="input-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                </div>

                <div class="input-group">
                    <select class="form-control" name="group_id">
                        @foreach ($group as $opction)
                            <option value="{{ $opction->id }}">
                                {{ $opction->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="kt-login__actions">
                    <button id="kt_login_signin_submit1" class="btn btn-pill kt-login__btn-primary">Sign In</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.kt-form').validate({ // initialize the plugin
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                    },
                }
            });
        });
    </script>
@endsection
