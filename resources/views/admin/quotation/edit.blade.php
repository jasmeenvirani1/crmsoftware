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
                    Vendors </a>   
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                    Update {{$title}} </a>   
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
                                    <a href="{{route('quotation.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('editquotation.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                        @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Company Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                            <input type="text" maxlength="50" name="company_name" value="{{old('company_name',isset($data->companyname)?$data->companyname:'')}}" id="company_name" class="form-control" placeholder="Company Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Contact Details</b></label>
                                            <div class="input-group demo control-group lst increment">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Name</b></label>
                                                <input type="text" maxlength="12" name="personmame[]" class="col-xl-2 col-lg-2 form-control">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Phone Number</b></label>
                                                <input type="text"maxlength="10" name="phonenumber[]"  class="col-xl-2 col-lg-2 form-control allownumericwithoutdecimal">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Email</b></label>
                                                <input type="text"  name="email[]" class="col-xl-2 col-lg-2 form-control">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-success products_img" type="button">Add</button>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if($data->personname)
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->personname as $key=>$path)
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Name</b></label>
                                                <input type="text" name="personmame[]"value="{{old('personmame',isset($path)?$path:'')}}" class="col-xl-2 col-lg-2 form-control">
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if($data->phonenumber)
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->phonenumber as $key=>$path)
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>phonenumber</b></label>
                                                <input type="text" name="phonenumber[]"value="{{old('phonenumber',isset($path)?$path:'')}}" class="col-xl-2 col-lg-2 form-control">
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if($data->email)
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->email as $key=>$path)
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>EMail</b></label>
                                                <input type="text" name="email[]"value="{{old('email',isset($path)?$path:'')}}" class="col-xl-2 col-lg-2 form-control">
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                            <div class="clone hide d-none">
                                                <div class="demo control-group lst input-group" style="margin-top:10px">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Name</b></label>
                                                <input type="text" maxlength="10" name="personmame[]" class="col-xl-2 col-lg-2 form-control">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Phone Number</b></label>
                                                <input type="text" maxlength="10" name="phonenumber[]"  class="col-xl-2 col-lg-2 form-control allownumericwithoutdecimal">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Email</b></label>
                                                <input type="text"  name="email[]" class="col-xl-2 col-lg-2 form-control">
                                                    <button class="btn btn-danger remove_btn" type="button">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Address</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                            <input type="text" maxlength="50" name="address" value="{{old('address',isset($data->address)?$data->address:'')}}" id="address" class="form-control" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>GST IN</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                            <input type="text" maxlength="16" name="gstin" value="{{old('gstin',isset($data->gst)?$data->gst:'')}}" id="gstin" class="form-control gst" placeholder="Gst Details">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Notes</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                            <input type="text" maxlength="20" name="notes" value="{{old('notes',isset($data->notes)?$data->notes:'')}}" id="notes" class="form-control" placeholder="Notes">
                                            </div>
                                        </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Quotation No.</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="text"  name="quotation_of" value="{{$data->quotation_of}}" id="quotation_no" class="form-control" placeholder="Quotation_No" readonly> 
                                                <input type="hidden" id="quotation_of"  name="quotation_no" value="{{$data->quotation_no}}"  class="form-control" >
                                            </div> -->
                                            <!-- <div class="col-lg-5 col-xl-2">
                                                <select class="form-control selectpicker" id="revision" name="revision_no" data-live-search="true">
                                                <option value="R0" {{ $data->revision_no == 'R0' ? 'selected' : '' }}>R0</option>
                                                <option value="R1" {{ $data->revision_no == 'R1' ? 'selected' : '' }}>R1</option>
                                                <option value="R2" {{ $data->revision_no == 'R2' ? 'selected' : '' }}>R2</option>
                                                <option value="R3" {{ $data->revision_no == 'R3' ? 'selected' : '' }}>R3</option>
                                                <option value="R4" {{ $data->revision_no == 'R4' ? 'selected' : '' }}>R4</option>
                                                <option value="R5" {{ $data->revision_no == 'R5' ? 'selected' : '' }}>R5</option>
                                                <option value="R6" {{ $data->revision_no == 'R6' ? 'selected' : '' }}>R6</option>
                                                <option value="R7" {{ $data->revision_no == 'R7' ? 'selected' : '' }}>R7</option>
                                                <option value="R8" {{ $data->revision_no == 'R8' ? 'selected' : '' }}>R8</option>
                                                <option value="R9" {{ $data->revision_no == 'R9' ? 'selected' : '' }}>R9</option>
                                                <option value="R10" {{ $data->revision_no == 'R10' ? 'selected' : '' }}>R10</option>
                                                </select>
                                            </div> -->
                                        <!-- </div> -->
                                        <!-- <div class="form-group row" id="add_button">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Customer Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <select class="form-control selectpicker" id="customer_name" name="customer_name" data-live-search="true">
                                                    <option value="">---SELECT---</option>
                                                    @foreach($customer as $customers)
                                                    <option value="{{$customers->id}}" {{ $data->customer_name == $customers->id ? 'selected' : '' }}>{{$customers->company_name}}</option>
                                                    @endforeach
                                                </select></div>
                                                <a class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" id="add_button1" aria-expanded="false">
                                                <i class="flaticon2-plus"></i><span style="color:white;">Add Customer</span></a>
                                        </div> -->
                                        <!-- <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Price Unit</b><span class="text-danger">*</span></label>
                                        <div class="col-lg-9 col-xl-4">  
                                            <select class="form-control selectpicker" id="price_unit" name="price_unit" data-live-search="true" required>
                                                <option value="">---SELECT---</option>
                                                <option value="$" {{ $data->price_unit == '$' ? 'selected' : '' }}>$(Dollar)</option>
                                                <option value="₹" {{ $data->price_unit == '₹' ? 'selected' : '' }}>₹(INR)</option>
                                                <option value="Other" {{ $data->price_unit == 'Other' ? 'selected' : '' }} >Other</option>
                                            </select> 
                                        </div>
                                    </div>   -->
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
        $(".products_img").click(function() {
                    console.log("product");
                    var lsthmtl = $(".clone").html();
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
    function table (that) {
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

