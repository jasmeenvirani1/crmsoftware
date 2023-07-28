<?php

use Request as Input;
?>
@extends('layouts.admin')
<style type="text/css">
    div#profile_picture-error {
        position: fixed;
        bottom: -20px;
        width: 100%;
        max-width: 100%;
        display: flex;
        white-space: nowrap;
        left: 0;
    }
    .kt-avatar {
        transform: translate(0, 0);
    }
    .kt-avatar .kt-avatar__upload i {
        position: absolute;
    }
    .kt-section__body {
        margin-top: 5px;
    }
</style>
@section('content')
<!-- begin:: Bradcrubs -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><a href="{{route('dashboard')}}">Home</a></h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>       
            <h3 class="kt-subheader__title">My Profile</h3>

            <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
                <input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                    <span><i class="flaticon2-search-1"></i></span>
                </span>
            </div>
        </div>                              
    </div>
</div>

<!-- end:: Breadcrubms -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::App-->
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        <!--Begin:: App Aside Mobile Toggle-->
        <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
            <i class="la la-close"></i>
        </button>
        <!--End:: App Aside Mobile Toggle-->
        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    @include('errormessage')
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Personal Information <small>update your personal informaiton</small></h3>
                            </div>
                        </div>
                        <form action="{{ route('saveprofile') }}" method="POST" id="update_profile" name="update_profile" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                            <div class="col-lg-9 col-xl-4">   
                                                <input type="text" name="name" value="{{old('name',$data->name)}}" id="name" class="form-control"> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="email" value="{{old('email',$data->email)}}" id="email" class="form-control" placeholder="email" disabled="true"> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Mobile</label>
                                            <div class="col-lg-9 col-xl-1">
                                                <input type="text" name="mobile_number" value="{{old('mobile_number',$data->mobile_number)}}" id="mobile_number" class="form-control" placeholder="mobile_number" disabled="true"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-success">Submit</button>&nbsp;
                                            <button type="button" id="cancel_btn" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End::App-->
</div>
<!-- end :: Contest --> 
@endsection

@section('script')
<script src="{{url('assets/admin/js/pages/custom/user/profile.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {

    $.validator.addMethod("alpha", function (value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    }, "Letters only please");

    $('#update_profile').validate({// initialize the plugin            
        errorLabelContainer: "#messageBox",
        rules: {
            name: {
                required: true,
                alpha: true
            },
            email: {
                required: true,
            },
            mobile_number: {
                required: true,
            }
        },
        //messages: {"profile_picture": {accept: "<br/>Invalid file format, JPG, JPEG, PNG and GIF is allowed only."}}
    });

    $("#cancel_btn").bind("click", function () {
        window.location.href = "{{route('dashboard')}}";
    });
});
</script>
@endsection
