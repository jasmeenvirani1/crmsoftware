@extends('layouts.admin')

@section('content')
<!-- begin:: Bradcrubs -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title"><a href="{{route('dashboard')}}">Home</a></h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>       
            <h3 class="kt-subheader__title">Change Password</h3>

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

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">              
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">                             
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                <div class="col-xl-12">
                    @include('errormessage')
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">Change Password<small>change or reset your account password</small></h3>
                            </div>                         
                        </div>
                        <form method="POST" action="{{ route('update-password') }}" class="kt-form kt-form--label-right" id="change_password" name="change_password" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">                                                    
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-lg-9 col-xl-3"> 
                                                <input id="cuurent_password" type="password" class="form-control @error('cuurent_password') is-invalid @enderror" name="cuurent_password" placeholder="Current password"> 
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-lg-9 col-xl-3">            
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New password"> 
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Confirm Password</label>
                                            <div class="col-lg-9 col-xl-3">           
                                                <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" placeholder="Confirm password"> 
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
                                            <button type="submit" class="btn btn-success">Change Password</button>&nbsp;
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#change_password').validate({// initialize the plugin            
            rules: {
                cuurent_password: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                }
            }
        });
    });

    $("#cancel_btn").bind("click", function () {
        window.location.href = "{{route('dashboard')}}";
    });

</script>
@endsection
