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
                <a href="{{url('admin/vendor')}}" class="kt-subheader__breadcrumbs-link">
                    Vendor </a>
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
                                    <a href="{{route('vendor.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('vendor.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Company Name</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" name="vendor_company_name" value="{{old('vendor_company_name',isset($data->vendor_company_name)?$data->vendor_company_name:'')}}" id="vendor_company_name" class="form-control" placeholder="Vendor Company Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Company Address</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <textarea name="vendor_company_address" id="vendor_company_address" class="form-control" placeholder="Vendor_Company_Address">{{old('vendor_company_address',isset($data->vendor_company_address)?$data->vendor_company_address:'')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Company Country</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <select class="form-control" id="vendor_company_country" name="vendor_company_country" >
                                                    <option value="">---SELECT---</option>
                                                    @foreach($country as $countries)
                                                    <option value="{{$countries->id}}">{{$countries->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Company State</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <select class="form-control" id="vendor_company_state" name="vendor_company_state" >
                                                    <!-- <option value="">---SELECT---</option>
                                                    <option value="Gujarat">Gujarat</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Company City</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <select class="form-control" id="vendor_company_city" name="vendor_company_city">
                                                    <!-- <option value="">---SELECT---</option>
                                                    <option value="Ahemedabad">Ahmedabad</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Company Pincode</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" name="vendor_company_pincode" value="{{old('vendor_company_pincode',isset($data->vendor_company_pincode)?$data->vendor_company_pincode:'')}}" id="vendor_company_pincode" class="form-control" pattern="[0-9]{6}" placeholder="Pincode" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Contact No.</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="tel" name="vendor_contact_no" value="{{old('vendor_contact_no',isset($data->vendor_contact_no)?$data->vendor_contact_no:'')}}" id="vendor_contact_no" class="form-control" placeholder="9876543210" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Email Id</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="email" name="email" value="{{old('email',isset($data->email)?$data->email:'')}}" id="email" class="form-control" placeholder="abc@gmail.com">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor GST No.</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" name="vendor_gst_no" value="{{old('vendor_gst_no',isset($data->vendor_gst_no)?$data->vendor_gst_no:'')}}" id="vendor_gst_no" class="form-control" placeholder="Vendor Gst No.">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor PAN No.</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" name="vendor_pan_no" value="{{old('vendor_pan_no',isset($data->vendor_pan_no)?$data->vendor_pan_no:'')}}" id="vendor_pan_no" class="form-control" placeholder="Vendor PAN No.">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor Name</b></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" name="name" value="{{old('name',isset($data->name)?$data->name:'')}}" id="name" class="form-control" placeholder="Vendor Name">
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
                                            <button type="submit" class="btn btn-success">{{$btn}}</button>&nbsp;
                                            <a href="{{route('vendor.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
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
        $.validator.addMethod("alpha", function (value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
        }, "Letters only please");
    });
</script>
<script>
$(document).ready(function() {
        $('#vendor_company_country').on('change', function() {
                            var country_id = this.value;
                            $("#vendor_company_state").html('');
                $.ajax({
                            url:"{{url('getstate')}}",
                            type: "POST",
                            data: {
                            country_id: country_id,
                            _token: '{{csrf_token()}}'
                            },
                            dataType : 'json',
                            success: function(result){
                            $.each(result.states,function(key,value){
                            $("#vendor_company_state").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                            $('#vendor_company_city').html('<option value="">Select State First</option>');
                            }
                    });
                });
                 $('#vendor_company_state').on('change', function() {
                                var state_id = this.value;
                                $("#vendor_company_city").html('');
                        $.ajax({
                                    url:"{{url('get-cities-by-state')}}",
                                    type: "POST",
                                    data: {
                                    state_id: state_id,
                                    _token: '{{csrf_token()}}'
                                    },
                                    dataType : 'json',
                                    success: function(result){
                                    $('#vendor_company_city').html('<option value="">Select City</option>');
                                    $.each(result.cities,function(key,value){
                                    $("#vendor_company_city").append('<option value="'+value.id+'">'+value.name+'</option>');
                                    });
                                }
                            });
                        });
        });
</script>
@endsection
