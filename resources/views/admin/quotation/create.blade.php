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
                <a href="{{url('admin/quotation')}}" class="kt-subheader__breadcrumbs-link">
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
                                <h3 class="kt-portlet__head-title">{{$title}}<small>{{isset($data->id) ? 'Update': 'Create'}} </small></h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <a href="{{route('quotation.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('quotation.store') }}" method="POST" id="create_category" name="create_category" class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Company Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" maxlength="20" name="company_name" id="company_name" class="form-control" placeholder="Company Name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Contact Details</hiiib></label>
                                            <div class="input-group demo control-group lst increment">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Name</b></label>
                                                <input type="text" maxlength="12"  name="personmame[]" class="col-xl-3 col-lg-3 form-control">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Phone Number</b></label>
                                                <input type="text" maxlength="12" name="phonenumber[]" class="col-xl-2 col-lg-2 form-control allownumericwithoutdecimal">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Email</b></label>
                                                <input type="text"  name="email[]" class="col-xl-2 col-lg-2 form-control">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-success products_img" type="button">Add</button>
                                                </div>
                                            </div>
                                            <div class="clone hidden d-none">
                                                <div class="demo control-group lst input-group" style="margin-top:10px">
                                                    <label class="col-xl-2 col-lg-2 col-form-label"><b> Name</b></label>
                                                    <input type="text" maxlength="12" name="personmame[]" class="col-xl-3 col-lg-3 form-control">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><b> Phone Number</b></label>
                                                    <input type="text" maxlength="12" name="phonenumber[]" class="col-xl-2 col-lg-2 form-control allownumericwithoutdecimal">
                                                    <label class="col-xl-3 col-lg-3 col-form-label"><b>Email</b></label>
                                                    <input type="text"  name="email[]" class="col-xl-2 col-lg-2 form-control">
                                                    <button class="btn btn-danger remove_btn" type="button">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Address</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" maxlength="50" name="address" id="address" class="form-control" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>GST IN</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" maxlength="16" name="gstin" id="gstin" class="form-control gst" placeholder="Gst Details">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Notes</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" maxlength="50"  name="notes" id="notes" class="form-control" placeholder="Notes">
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row" id="add_button">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Customer Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <select class="form-control selectpicker" id="customer_name" name="customer_name" data-live-search="true" required>
                                                    <option value="">---SELECT---</option>
                                                    @foreach($customer as $customers)
                                                    <option value="{{$customers->id}}">{{$customers->company_name}}</option>
                                                    @endforeach
                                                </select></div>
                                                <a class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" id="add_button1" aria-expanded="false">
                                                <i class="flaticon2-plus"></i><span style="color:white;">Add Customer</span>
                                            </a>
                                        </div> -->
                                        <!-- <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Price Unit</b><span class="text-danger">*</span></label>
                                        <div class="col-lg-9 col-xl-4">  
                                            <select class="form-control selectpicker" id="price_unit" name="price_unit" data-live-search="true" required>
                                                <option value="">---SELECT---</option>
                                                <option value="$">$(Dollar)</option>
                                                <option value="₹" >₹(INR)</option>
                                                <option value="Other" >Other</option>
                                            </select> 
                                        </div>
                                    </div> -->
                                        <!-- <div class="form-group row" id="ts1">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Add Product</b></label>
                                            <a id="ts" class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" aria-expanded="false">
                                                        <i class="flaticon2-plus"></i><span style="color:white;">Add Product</span>
                                            </a> -->
                                    </div>
                                    <!-- <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Prepared By:</b><span class="text-danger">*</span></label>
                                                <div class="col-lg-4 col-xl-4"> 
                                                    <input class="form-control" type="text" name="prepared_by" id="prepared_by" value="{{Auth::user()->name}}" required="">
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
                                    <button type="submit" class="btn btn-success">Save</button>&nbsp;
                                    <a href="{{route('quotation.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
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
    $(document).ready(function() {
        $.validator.addMethod("alpha", function(value, element) {
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
        $(".products_img").click(function() {
            var lsthmtl = $(".clone").html();
            console.log(lsthmtl);
            $(".increment").after(lsthmtl);
        });
        $("body").on("click", ".remove_btn", function() {
            $(this).parents(".demo").remove();
        });
        // $(".gst").change(function () {    
        //         var inputvalues = $(this).val();    
        //         var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');    
        //         if (gstinformat.test(inputvalues)) {    
        //             return true;    
        //         } else {    
        //             alert('Please Enter Valid GSTIN Number');    
        //             $(".gst").val('');    
        //             $(".gst").focus();    
        //         }    
        //     });          
    });

    function table(that) {
        $(that).closest('table.trmv').remove()
    }
    $(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
</script>
@endsection