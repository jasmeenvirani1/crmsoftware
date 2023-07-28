@extends('layouts.admin')
@section('content')
<!-- begin:: Bradcrubs -->
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{route('dashboard')}}" class="kt-subheader__breadcrumbs-link">
                    Dashboard </a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="{{url('admin/role')}}" class="kt-subheader__breadcrumbs-link">
                    Role </a>   
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                    Add {{$title}} </a>   
            </div>
        </div>         
    </div>
</div>

<!-- end:: Breadcrubms -->

<!-- begin:: Content -->

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
                                <h3 class="kt-portlet__head-title">{{$title}}<small>{{isset($data->id) ? 'Update': 'Create'}}  </small></h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <a href="{{route('role.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('role.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf 
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>User Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="user_name" value="{{old('user_name',isset($data->user_name)?$data->user_name:'')}}" id="user_name" class="form-control" placeholder="UserName" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Email ID</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="email" name="email_id" value="{{old('email_id',isset($data->email_id)?$data->email_id:'')}}" id="email_id" class="form-control" placeholder="EmailID" required> 
                                            </div>
                                            <div class="col-lg-5 col-xl-4"><label class="col-form-label text-danger">(This Email Id Use For Login)</label></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Phone</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="tel" name="phone" value="{{old('phone',isset($data->phone)?$data->phone:'')}}" id="phone" class="form-control" placeholder="Phone" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Password</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="password" name="password" value="{{old('password',isset($data->password)?$data->password:'')}}" id="password" class="form-control" placeholder="Password" required> 
                                            </div>
                                            <div class="col-lg-5 col-xl-4"><label class="col-form-label text-danger">(This Password Use For Login)</label></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Confirm Password</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="password" name="confirm_password" value="{{old('confirm_password',isset($data->confirm_password)?$data->confirm_password:'')}}" id="confirm_password" class="form-control" placeholder="ConfirmPassword" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Designation</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="designation" value="{{old('designation',isset($data->designation)?$data->designation:'')}}" id="designation" class="form-control" placeholder="Designation" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="organization"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Organization</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="user_role"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>User(Role)</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="sales"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Sales</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="inventory_management"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Inventory Management</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="purchase"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Purchase</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="customer"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Customer</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="technical_specification"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Technical Specification</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="terms"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Terms</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="notification"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Notification</b></label>
                                                </span>
                                            </div>
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="setting"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Setting</b></label>
                                                </span>
                                            </div>
                                            <!-- <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="technical_specification"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Technical Specification</b></label>
                                                </span>
                                            </div> -->
                                        </div>
                                        <!-- <div class="form-group row">
                                            <div class="col-lg-2 col-xl-2">  
                                                <span class="switch switch-info">
                                                    <label>
                                                        <input type="checkbox" name="terms"/>
                                                        <span></span>
                                                    </label>
                                                    <label><b>Terms</b></label>
                                                </span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-success" onclick="return Validate()">{{$btn}}</button>&nbsp;
                                            <a href="{{route('role.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
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
<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("alpha", function (value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
        }, "Letters only please");

        $('#create_category').validate({
            rules: {
                name: {
                    required: true,
                    alpha: true
                }
            },
        });
    });
</script>
@endsection
