@extends('layouts.admin')
@section('content')
<style type="text/css">
  &lt;div class="card card-custom"&gt;
             &lt;div class="card-header"&gt;
              &lt;h3 class="card-title"&gt;
               Bootstrap Date Picker Examples
              &lt;/h3&gt;
             &lt;/div&gt;
             &lt;!--begin::Form--&gt;
             &lt;form class="form"&gt;
              &lt;div class="card-body"&gt;
               &lt;div class="form-group row"&gt;
                &lt;label class="col-form-label text-right col-lg-3 col-sm-12"&gt;Minimum Setup&lt;/label&gt;
                &lt;div class="col-lg-4 col-md-9 col-sm-12"&gt;
                 &lt;input type="text" class="form-control" readonly placeholder="Select date"/&gt;
                &lt;/div&gt;
               &lt;/div&gt;
               &lt;div class="form-group row"&gt;
                &lt;label class="col-form-label text-right col-lg-3 col-sm-12"&gt;Input Group Setup&lt;/label&gt;
                &lt;div class="col-lg-4 col-md-9 col-sm-12"&gt;
                 &lt;div class="input-group date"&gt;
                  &lt;input type="text" class="form-control" readonly  placeholder="Select date"/&gt;
                  &lt;div class="input-group-append"&gt;
                   &lt;span class="input-group-text"&gt;
                    &lt;i class="la la-calendar-check-o"&gt;&lt;/i&gt;
                   &lt;/span&gt;
                  &lt;/div&gt;
                 &lt;/div&gt;
                &lt;/div&gt;
               &lt;/div&gt;
               &lt;div class="form-group row"&gt;
                &lt;label class="col-form-label text-right col-lg-3 col-sm-12"&gt;Enable Helper Buttons&lt;/label&gt;
                &lt;div class="col-lg-4 col-md-9 col-sm-12"&gt;
                 &lt;div class="input-group date" &gt;
                  &lt;input type="text" class="form-control" readonly  value="05/20/2017" id="kt_datepicker_3"/&gt;
                  &lt;div class="input-group-append"&gt;
                   &lt;span class="input-group-text"&gt;
                    &lt;i class="la la-calendar"&gt;&lt;/i&gt;
                   &lt;/span&gt;
                  &lt;/div&gt;
                 &lt;/div&gt;
                 &lt;span class="form-text text-muted"&gt;Enable clear and today helper buttons&lt;/span&gt;
                &lt;/div&gt;
               &lt;/div&gt;
               &lt;div class="form-group row"&gt;
                &lt;label class="col-form-label text-right col-lg-3 col-sm-12"&gt;Orientation&lt;/label&gt;
                &lt;div class="col-lg-4 col-md-9 col-sm-12"&gt;
                 &lt;div class="input-group date mb-2" &gt;
                  &lt;input type="text" class="form-control" placeholder="Top left" id="kt_datepicker_4_1"/&gt;
                  &lt;div class="input-group-append"&gt;
                  &lt;span class="input-group-text"&gt;
                   &lt;i class="la la-bullhorn"&gt;&lt;/i&gt;
                   &lt;/span&gt;
                  &lt;/div&gt;
                 &lt;/div&gt;

                 &lt;div class="input-group date mb-2"&gt;
                  &lt;input type="text" class="form-control" placeholder="Top right" id="kt_datepicker_4_2"/&gt;
                  &lt;div class="input-group-append"&gt;
                   &lt;span class="input-group-text"&gt;
                   &lt;i class="la la-clock-o"&gt;&lt;/i&gt;
                   &lt;/span&gt;
                  &lt;/div&gt;
                 &lt;/div&gt;

                 &lt;div class="input-group date mb-2"&gt;
                  &lt;input type="text" class="form-control" placeholder="Bottom left"  id="kt_datepicker_4_3"/&gt;
                  &lt;div class="input-group-append"&gt;
                   &lt;span class="input-group-text"&gt;
                   &lt;i class="la la-check"&gt;&lt;/i&gt;
                   &lt;/span&gt;
                  &lt;/div&gt;
                 &lt;/div&gt;

                 &lt;div class="input-group date"&gt;
                  &lt;input type="text" class="form-control" placeholder="Bottom right" id="kt_datepicker_4_4"/&gt;
                  &lt;div class="input-group-append"&gt;
                   &lt;span class="input-group-text"&gt;
                   &lt;i class="la la-check-circle-o"&gt;&lt;/i&gt;
                   &lt;/span&gt;
                  &lt;/div&gt;
                 &lt;/div&gt;
                &lt;/div&gt;
               &lt;/div&gt;
               &lt;div class="form-group row"&gt;
                &lt;label class="col-form-label text-right col-lg-3 col-sm-12"&gt;Range Picker&lt;/label&gt;
                &lt;div class="col-lg-4 col-md-9 col-sm-12"&gt;
                 &lt;div class="input-daterange input-group" id="kt_datepicker_5"&gt;
                  &lt;input type="text" class="form-control" name="start"/&gt;
                  &lt;div class="input-group-append"&gt;
                   &lt;span class="input-group-text"&gt;&lt;i class="la la-ellipsis-h"&gt;&lt;/i&gt;&lt;/span&gt;
                  &lt;/div&gt;
                  &lt;input type="text" class="form-control" name="end"/&gt;
                 &lt;/div&gt;
                 &lt;span class="form-text text-muted"&gt;Linked pickers for date range selection&lt;/span&gt;
                &lt;/div&gt;
               &lt;/div&gt;
               &lt;div class="form-group row"&gt;
                &lt;label class="col-form-label text-right col-lg-3 col-sm-12"&gt;Inline Mode&lt;/label&gt;
                &lt;div class="col-lg-4 col-md-9 col-sm-12"&gt;
                 &lt;div class id="kt_datepicker_6"&gt;&lt;/div&gt;
                &lt;/div&gt;
               &lt;/div&gt;
               &lt;div class="form-group row"&gt;
                &lt;label class="col-form-label text-right col-lg-3 col-sm-12"&gt;Modal Demos&lt;/label&gt;
                &lt;div class="col-lg-4 col-md-9 col-sm-12"&gt;
                 &lt;a href="#" class="btn font-weight-bold btn-light-primary" data-toggle="modal" data-target="#kt_datepicker_modal"&gt;Launch modal datepickers&lt;/a&gt;
                &lt;/div&gt;
               &lt;/div&gt;
              &lt;/div&gt;
              &lt;div class="card-footer"&gt;
               &lt;div class="form-group row"&gt;
                &lt;div class="col-lg-9 ml-lg-auto"&gt;
                 &lt;button type="reset" class="btn btn-primary mr-2"&gt;Submit&lt;/button&gt;
                 &lt;button type="reset" class="btn btn-secondary"&gt;Cancel&lt;/button&gt;
                &lt;/div&gt;
               &lt;/div&gt;
              &lt;/div&gt;
             &lt;/form&gt;
             &lt;!--end::Form--&gt;
            &lt;/div&gt;
</style>
<script type="text/javascript">
    // Class definition

            var KTBootstrapDatepicker = function () {

             var arrows;
             if (KTUtil.isRTL()) {
              arrows = {
               leftArrow: '&lt;i class="la la-angle-right"&gt;&lt;/i&gt;',
               rightArrow: '&lt;i class="la la-angle-left"&gt;&lt;/i&gt;'
              }
             } else {
              arrows = {
               leftArrow: '&lt;i class="la la-angle-left"&gt;&lt;/i&gt;',
               rightArrow: '&lt;i class="la la-angle-right"&gt;&lt;/i&gt;'
              }
             }

             // Private functions
             var demos = function () {
              // minimum setup
              $('#kt_datepicker_1').datepicker({
               rtl: KTUtil.isRTL(),
               todayHighlight: true,
               orientation: "bottom left",
               templates: arrows
              });
             return {
              // public functions
              init: function() {
               demos();
              }
             };
            }();

            jQuery(document).ready(function() {
             KTBootstrapDatepicker.init();
            });
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
   $("#date").change(function(){
     var selectedValue = $(this).val();
     var date = new Date();
     date.setDate(date.getDate() + parseInt(selectedValue));
     document.getElementById('kt_datepicker_1').value = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear();
    });
});
</script>
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
                    Quotation </a>   
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
                                    <a href="{{route('quotation.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('quotation.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                        @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Quotation No.</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="text"  name="quotation_no[]" value="{{$data1}}" id="quotation_no" class="form-control" placeholder="Quotation_No" readonly> 
                                            </div>
                                            <div class="col-lg-5 col-xl-2">
                                                <select class="form-control selectpicker" id="revision" name="quotation_no[]" data-live-search="true"><option value="R0">R0</option>
                                                 <option value="R1">R1</option>
                                                 <option value="R2">R2</option>
                                                 <option value="R3">R3</option>
                                                 <option value="R4">R4</option>
                                                 <option value="R5">R5</option>
                                                 <option value="R6">R6</option>
                                                 <option value="R7">R7</option>
                                                 <option value="R8">R8</option>
                                                 <option value="R9">R9</option>
                                                 <option value="R10">R10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="add_button">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Customer Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <select class="form-control selectpicker" id="customer_name" name="customer_name" data-live-search="true">
                                                    <option value="">---SELECT---</option>
                                                    @foreach($customer as $customers)
                                                    <option value="{{$customers->id}}">{{$customers->name}}</option>
                                                    @endforeach
                                                </select></div>
                                                <button class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" id="add_button1" aria-expanded="false">
                                                <i class="flaticon2-plus"></i>Add Item
                                            </button>
                                        </div>
                                        <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Priority</b><span class="text-danger">*</span></label>
                                        <div class="col-lg-9 col-xl-4">  
                                            <select class="form-control selectpicker" id="priority" name="priority" data-live-search="true" required>
                                                <option value="">---SELECT---</option>
                                                <option value="High">High</option>
                                                <option value="Medium" >Medium</option>
                                                <option value="Low" >Low</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>FollowUp On Quotation</b><span class="text-danger">*</span></label>
                                        <div class="col-lg-4 col-xl-4">  
                                            <select class="form-control selectpicker" name="follow_up" id="date" data-live-search="true">
                                                <option value="">---SELECT---</option>
                                                <option value="0">Today Evening</option>
                                                <option value="1">Tomorrow</option>
                                                <option value="5">After 5 Days</option>
                                                <option value="10">After 10 Days</option>
                                                <option value="15">After 15 Days</option>
                                                <option value="30">After 30 Days</option>
                                            </select> 
                                        </div>
                                        <div class="col-lg-2 col-xl-2"> 
                                        <input type="text" name="follow_up" id="kt_datepicker_1" class="form-control" placeholder="DD-MM-YYYY">  
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Product Name</b></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="product_name" required> 
                                            </div>
                                        </div> -->
                                        <div class="form-group row" id="ts1">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Add Product</b></label>
                                            <button id="ts" class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" aria-expanded="false">
                                                        <i class="flaticon2-plus"></i>Add Product
                                            </button>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Prepared By:</b></label>
                                                <div class="col-lg-4 col-xl-4"> 
                                                    <input class="form-control" type="text" name="prepared_by" id="prepared_by" value="{{Auth::user()->name}}">
                                                <!-- <select class="form-control selectpicker" id="prepared_by" name="prepared_by" data-live-search="true" required>
                                                    <option value="">---SELECT---</option>
                                                    @foreach($user as $user1)
                                                    <option value="{{$user1->name}}">{{$user1->name}}</option>
                                                    @endforeach
                                                </select> -->
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Select Terms</b></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <select class="form-control" id="terms" name="terms" required>
                                                    <option value="">---SELECT---</option>
                                                    @foreach($terms as $term)
                                                    <option value="{{$term->title}}">{{$term->title}}</option>
                                                    @endforeach
                                                </select></div>
                                        </div> -->
                                        <!-- <table class="table table-striped" id="tb"><tr><th>Description</th><th>Quantity</th><th>Unit Price</th><th>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="tb1" class="btn btn-brand btn-icon-sm" aria-expanded="false">Add Data</button></th></tr>
                                            <tr><td><select class="form-control" name="description"><option value="">---SELECT---</option><option value="">Data of The Table</option></select></td><td><input class="form-control" type="number" name="quantity"></td><td><input class="form-control" type="number" name="unit_price"></td><td><input class="form-control" type="number" name="total_price"></td></tr></table> -->
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
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    var itemCount1 = 1;
    var wrapper = $("#ts1");
    var add_button = $("#ts");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<table border="2"><tr><td><table class="table table-striped" id="d_'+itemCount1+'" border="2"><tr><th colspan="6">Description</th><th>HSN Code/SAC Code</th><th>Unit Price(INR)</th><th>Qty.</th><th>Total Price(INR)</th></tr><tr><th colspan="1">Product</th><td colspan="5"><select class="form-control" id="product_name" name="product_name'+itemCount1+'" data-live-search="true" required><option value="">---SELECT---</option>@foreach($product as $products)<option value="{{$products->product_name}}">{{$products->product_name}}</option>@endforeach</select></td><td rowspan="3" colspan="4" id="add_field"><center><button id="add_field1_'+itemCount1+'" onclick="a_d('+itemCount1+');" class="btn btn-brand btn-icon-sm" aria-expanded="false"><i class="flaticon2-plus"></i>Add Dimension</button></center></td></tr><tr><th colspan="3">Internal Dimension</th><th colspan="3">External Dimension</th></tr><tr><th>Width</th><th>Depth</th><th>Height</th><th>Width</th><th>Depth</th><th>Height</th></tr><tr><td><input type="number" name="i_d_width'+itemCount1+'[]" id="width" class="form-control" placeholder="Width" required></td><td><input type="number" name="i_d_depth'+itemCount1+'[]" id="depth" class="form-control" placeholder="Depth" required></td><td><input type="number" name="i_d_height'+itemCount1+'[]" id="height" class="form-control" placeholder="Height" required></td><td><input type="number" name="e_d_width'+itemCount1+'[]" id="width" class="form-control" placeholder="Width" required></td><td><input type="number" name="e_d_depth'+itemCount1+'[]" id="depth" class="form-control" placeholder="Depth" required></td><td><input type="number" name="e_d_height'+itemCount1+'[]" id="height" class="form-control" placeholder="Height" required></td><td><input type="number" name="h_s_code'+itemCount1+'[]" id="h_s_code" class="form-control" placeholder="HSN/SAC Code" required></td><td><input type="number" name="unit_price'+itemCount1+'[]" id="unit_price_'+itemCount1+'_'+itemCount1+'" oninput="getamount('+itemCount1+');" class="form-control" placeholder="Unit Price" required></td><td><input type="number" name="quantity'+itemCount1+'[]" id="quantity_'+itemCount1+'_'+itemCount1+'" oninput="getamount('+itemCount1+');" class="form-control" placeholder="Qty." required></td><td><input type="number" name="total_price'+itemCount1+'[]" id="total_price_'+itemCount1+'_'+itemCount1+'" class="form-control" placeholder="Total Price" readonly></td></tr></table><input type="hidden" name="itemCount[]"  id="itemCount" value="'+itemCount1+'"></td></tr><tr><td><div class="col-xl-12 col-lg-12 form-group row"><label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Select Technical Specification</b></label><div class="col-lg-4 col-xl-4"><select class="form-control" id="tech_specification_'+itemCount1+'" name="tech_specification'+itemCount1+'" onchange="getdata1('+itemCount1+');" data-live-search="true" required><option value="">---SELECT---</option>@foreach($tech as $tech1)<option value="{{$tech1->product_name}}">{{$tech1->product_name}}</option>@endforeach</select></div><div class="col-lg-5 col-xl-3"><center><button onclick="a_d1('+itemCount1+');" class="btn btn-brand btn-icon-sm" aria-expanded="false"><i class="flaticon2-plus"></i>Add TechnicalSpecification</button></center></div></div><div class="col-xl-12 col-lg-12 form-group row tech_specification" id="tech_spec_'+itemCount1+'"></div></td></tr><tr><td><div class="col-xl-12 col-lg-12 form-group row"><label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Select Terms</b></label><div class="col-lg-4 col-xl-4"><select class="form-control" id="terms_'+itemCount1+'" name="terms'+itemCount1+'" onchange="getdata('+itemCount1+');" data-live-search="true"  required><option value="">---SELECT---</option>@foreach($terms as $term)<option value="{{$term->title}}">{{$term->title}}</option>@endforeach</select></div><div class="col-lg-5 col-xl-3"><center><button onclick="term('+itemCount1+');" class="btn btn-brand btn-icon-sm" aria-expanded="false"><i class="flaticon2-plus"></i>Add Terms</button></center></div></div><div class="col-xl-12 col-lg-12 form-group row terms" id="term1_'+itemCount1+'"></div></tr></table><div class="form-group row"></div>');
            $('select').selectpicker();
            itemCount1++;
        });
});
let itemCount = 1;
function a_d(itemCount1){
    var wrapper = $("#d_"+itemCount1);
        $(wrapper).append('<tr><td><input type="number" name="i_d_width'+itemCount1+'[]" id="width" class="form-control" placeholder="Width" required></td><td><input type="number" name="i_d_depth'+itemCount1+'[]" id="depth" class="form-control" placeholder="Depth" required></td><td><input type="number" name="i_d_height'+itemCount1+'[]" id="height" class="form-control" placeholder="Height" required></td><td><input type="number" name="e_d_width'+itemCount1+'[]" id="width" class="form-control" placeholder="Width" required></td><td><input type="number" name="e_d_depth'+itemCount1+'[]" id="depth" class="form-control" placeholder="Depth" required></td><td><input type="number" name="e_d_height'+itemCount1+'[]" id="height" class="form-control" placeholder="Height" required></td><td><input type="number" name="h_s_code'+itemCount1+'[]" id="h_s_code" class="form-control" placeholder="HSN/SAC Code" required></td><td><input type="number" name="unit_price'+itemCount1+'[]" id="unit_price_'+itemCount+'" oninput="getamountadd('+itemCount+');" class="form-control" placeholder="Unit Price" required></td><td><input type="number" name="quantity'+itemCount1+'[]" id="quantity_'+itemCount+'" oninput="getamountadd('+itemCount+');" class="form-control" placeholder="Qty." required></td><td><input type="number" name="total_price'+itemCount1+'[]" id="total_price_'+itemCount+'" class="form-control" placeholder="Total Price" readonly></td></tr>');
        itemCount++;
    };
function a_d1(itemCount1){
    $("#tech_spec_"+itemCount1).append('<table class="col-xl-12 col-lg-12 table table-striped" border="2"><tr><th><label class="col-form-label"><b>Title</b></label></th><td><input type="text" name="title'+itemCount1+'[]" class="form-control"  required></td></tr><tr><th><label class="col-form-label"><b>Description</b></label></th><td><textarea class="form-control" name="details'+itemCount1+'[]" required></textarea></td></tr></table>');
};
function term(itemCount1){
    $("#term1_"+itemCount1).append('<table class="col-xl-12 col-lg-12 table table-striped" border="2"><tr><th><label class="col-form-label"><b>Title</b></label></th><td><input type="text" name="title1'+itemCount1+'[]" class="form-control"  required></td></tr><tr><th><label class="col-form-label"><b>Description</b></label></th><td><textarea class="form-control" name="description'+itemCount1+'[]" required></textarea></td></tr></table>');
};    
function getdata(itemCount1){
            var term = $("#terms_"+itemCount1).val();
                            $("#term1_"+itemCount1).html('');
                $.ajax({
                            url:"{{url('getterms')}}",
                            type: "POST",
                            data: {
                            term: term,
                            _token: '{{csrf_token()}}'
                            },
                            dataType : 'json',
                            success: function(result){
                            $.each(result.terms,function(key,value){
                                // var data1 = value.title.length;
                                // $i =0;
                                // for($j=0; $j<data1; $j++){
                            $("#term1_"+itemCount1).append('<table class="col-xl-12 col-lg-12 table table-striped" border="2"><tr><th><label class="col-form-label"><b>Title</b></label></th><td><input type="text" name="title1'+itemCount1+'[]" value='+value.title+' class="form-control"  required></td></tr><tr><th><label class="col-form-label"><b>Description</b></label></th><td><textarea class="form-control" name="description'+itemCount1+'[]" required>'+value.description+'</textarea></td></tr></table>');
                             // $i++;
                        // }
                        }); 
                            }
                    });
                };
function getdata1(itemCount1){
            var tech_specification = $("#tech_specification_"+itemCount1).val();
                            $("#tech_spec_"+itemCount1).html('');
                $.ajax({
                            url:"{{url('gettech_specification')}}",
                            type: "POST",
                            data: {
                            tech_specification: tech_specification,
                            _token: '{{csrf_token()}}'
                            },
                            dataType : 'json',
                            success: function(result){
                            $.each(result.tech_specification,function(key,value){
                                var data = value.title.length;
                                $i =0;
                                for($j=0; $j<data; $j++){
                            $("#tech_spec_"+itemCount1).append('<table class="col-xl-12 col-lg-12 table table-striped" border="2"><tr><th><label class="col-form-label"><b>Title</b></label></th><td><input type="text" name="title'+itemCount1+'[]" value='+value.title[$i]+' class="form-control"  required></td></tr><tr><th><label class="col-form-label"><b>Description</b></label></th><td><textarea class="form-control" name="details'+itemCount1+'[]" required>'+value.details[$i]+'</textarea></td></tr></table>');
                            $i++;
                        }
                        }); 
                        }
                    });
                };                   
</script>
<script type="text/javascript">
$(document).ready(function(){
    var wrapper = $("#add_button");
    var add_button = $("#add_button1");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<form action="{{ route('extracustomer.store') }}" method="POST" id="create_category" name="create_category" class="col-xl-12 col-lg-12 form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">@csrf<input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}"><table class="table table-striped"><tr><th>Name</th><td><input type="text" name="name" value="{{old('name',isset($data->name)?$data->name:'')}}" id="name" class="form-control" placeholder="Customer Name" required></td></tr><tr><th>Designation</th><td><input type="text" name="designation" value="{{old('designation',isset($data->designation)?$data->designation:'')}}" id="designation" class="form-control" placeholder="Designation" required></td></tr><tr><th>GST No.</th><td><input type="text" name="gst_no" value="{{old('gst_no',isset($data->gst_no)?$data->gst_no:'')}}" id="gst_no" class="form-control" placeholder="GST No."></td></tr><tr><th>Phone</th><td><input type="tel" name="phone" value="{{old('phone',isset($data->phone)?$data->phone:'')}}" id="phone" class="form-control" placeholder="Phone" pattern="[0-9]{3}[0-9]{4}[0-9]{3}" required></td></tr><tr><th>Email Id</th><td><input type="email" name="email" value="{{old('email',isset($data->email)?$data->email:'')}}" id="email" class="form-control" placeholder="abc@gmail.com" required></td></tr><tr><th>Company Name</th><td><input type="text" name="company_name" value="{{old('company_name',isset($data->company_name)?$data->company_name:'')}}" id="company_name" class="form-control" placeholder="Company Name" required></td></tr><tr><th>Company Address</th><td><textarea name="company_address" id="company_address" class="form-control" placeholder="company_address"required>{{old('company_address',isset($data->company_address)?$data->company_address:'')}}</textarea></td></tr><tr><td colspan="2"><center><button type="submit" class="btn btn-success">{{$btn}}</button>&nbsp;<a href="{{route('quotation.create')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a></center></td></tr></table></form>');

        });
});
</script>
<script type="text/javascript">
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
 $('#kt_datepicker_1').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: arrows
        });
 function getamount(itemCount1){
    var unit_price = $("#unit_price_"+itemCount1+"_"+itemCount1).val();
    var quantity = $("#quantity_"+itemCount1+"_"+itemCount1).val();
    $("#total_price_"+itemCount1+"_"+itemCount1).val(unit_price * quantity);
 }
 function getamountadd(itemCount){
    var unit_price = $("#unit_price_"+itemCount).val();
    var quantity = $("#quantity_"+itemCount).val();
    $("#total_price_"+itemCount).val(unit_price * quantity);
 }
 $(document).ready(function(){
    var wrapper = $("#tb");
    var add_button = $("#tb1");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<tr><td><select class="form-control" name="description"><option value="">---SELECT---</option><option value="">Data of The Table</option></select></td><td><input class="form-control" type="number" name="quantity"></td><td><input class="form-control" type="number" name="unit_price"></td><td><input class="form-control" type="number" name="total_price"></td></tr>');
    });
});
</script>
@endsection


<!-- <tr><th>Priority</th><td><select class="form-control" id="priority" name="priority" required><option value="">---SELECT---</option><option value="High">High</option><option value="Medium">Medium</option><option value="Low">Low</option></select></td></tr> -->
