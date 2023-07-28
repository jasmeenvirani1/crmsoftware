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
                <a href="{{url('admin/organization')}}" class="kt-subheader__breadcrumbs-link">
                    Organization </a>   
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
                                    <a href="{{route('organization.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('organization.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Organization Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="organization_name" value="{{old('organization_name',isset($data->organization_name)?$data->organization_name:'')}}" id="organization_name" class="form-control" placeholder="Organization Name" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row" id="add_button">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Email Id</b><span class="text-danger">*</span></label>
                                            <?php $count = count($data->email); ?>
                                            @for($i=0; $i<$count; $i++)
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="email" name="email[]" value="{{$data->email[$i]}}" id="email" class="form-control" placeholder="Email Id" required> 
                                            </div>
                                            @endfor
                                            <!-- <a class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" id="add_button1" aria-expanded="false">
                                                <i class="flaticon2-plus"></i><span style="color:white;">Add EmailId</span>
                                            </a>
                                            <div class="col-lg-2 col-xl-2"></div> -->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Website</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="website" value="{{old('website',isset($data->website)?$data->website:'')}}" id="website" class="form-control" placeholder="website" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>GST No.</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="gst_no" value="{{old('gst_no',isset($data->gst_no)?$data->gst_no:'')}}" id="gst_no" class="form-control" placeholder="GST No." required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Pancard No.</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="pancad_no" value="{{old('pancad_no',isset($data->pancad_no)?$data->pancad_no:'')}}" id="pancad_no" class="form-control" placeholder="Pancard No." required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Bank Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="bank_name" value="{{old('bank_name',isset($data->bank_name)?$data->bank_name:'')}}" id="bank_name" class="form-control" placeholder="Bank Name" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Account No.</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="account_no" value="{{old('account_no',isset($data->account_no)?$data->account_no:'')}}" id="account_no" class="form-control" placeholder="Account No." required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>IFSC Code</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="ifsc_code" value="{{old('ifsc_code',isset($data->ifsc_code)?$data->ifsc_code:'')}}" id="ifsc_code" class="form-control" placeholder="IFSC Code" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Bank Branch Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="branch_name" value="{{old('branch_name',isset($data->branch_name)?$data->branch_name:'')}}" id="branch_name" class="form-control" placeholder="Branch Name" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Contact No.</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="tel" name="contact_no[]" value="{{old('contact_no',isset($data->contact_no[0])?$data->contact_no[0]:'')}}" id="contact_no" class="form-control" pattern="[0-9]{3}[0-9]{4}[0-9]{3}" placeholder="Contact_No" required> 
                                            </div>
                                            <div class="col-lg-5 col-xl-4">  
                                                <input type="tel" name="contact_no[]" value="{{old('contact_no',isset($data->contact_no[1])?$data->contact_no[1]:'')}}" id="contact_no" class="form-control" pattern="[0-9]{3}[0-9]{4}[0-9]{3}" placeholder="Contact_No" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Full Address</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <textarea name="full_address" id="full_address" class="form-control" placeholder="Full Address"required>{{old('full_address',isset($data->full_address)?$data->full_address:'')}}</textarea> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Pincode</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="pincode" value="{{old('pincode',isset($data->pincode)?$data->pincode:'')}}" id="pincode" class="form-control" pattern="[0-9]{6}" maxlength="6" placeholder="Pincode" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Logo</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="file" name="logo" id="logo" class="form-control" placeholder="Logo" required> 
                                            </div>
                                            <div class="col-lg-9 col-xl-4">
                                            <img style="width: 200px; height: 65px;" src="{{asset('images/'.$data->logo)}}"> 
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
                                            <a href="{{route('organization.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
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
$(document).ready(function(){
    var wrapper = $("#add_button");
    var add_button = $("#add_button1");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<div class="col-lg-3 col-xl-3"></div><div class="col-lg-4 col-xl-4"><input type="email" name="email[]" value="" id="email" class="form-control" placeholder="Email Id" required></div>');
        });
});
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
