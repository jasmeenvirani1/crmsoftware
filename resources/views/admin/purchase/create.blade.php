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
                <a href="{{url('admin/purchase')}}" class="kt-subheader__breadcrumbs-link">
                    Purchase </a>   
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
                                    <a href="{{route('purchase.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('purchase.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                        @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Organization Name</b></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <!-- <input type="text" name="organization_name" id="organization_name" class="form-control" placeholder="Organization_Name" > --> 
                                                 <select class="form-control selectpicker" id="organization_name" name="organization_name" data-live-search="true" >
                                                    <option value="">---SELECT---</option>
                                                    @foreach($organization as $organizations)
                                                    <option value="{{$organizations->organization_name}}">{{$organizations->organization_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Ship To</b></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <textarea name="ship_to" id="ship_to" class="form-control" placeholder="Ship To" ></textarea>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>LPM No.</b></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="text" name="lpm_no" id="lpm_no" class="form-control" placeholder="LPM No." > 
                                            </div>
                                            <div class="col-lg-5 col-xl-2">
                                                <select class="form-control selectpicker" id="revision" name="revision_no" data-live-search="true"><option value="R0">R0</option>
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
                                        </div> -->
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>PO No.</b></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <input type="text" name="po_no" id="po_no" class="form-control" value="{{$demo2}}" readonly="" placeholder="PO No." >
                                                <input type="hidden" name="po_no_of" id="po_no_of" class="form-control" value="{{$demo1}}" readonly="" > 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Project Credentials</b></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="project_credentials" id="project_credentials" class="form-control" placeholder="ProjectName" > 
                                            </div>
                                        </div>
                                        <div class="form-group row" id="add_button">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Vendor Name</b></label>
                                            <div class="col-lg-4 col-xl-4">  
                                                <select class="form-control selectpicker" id="vendor_name" name="vendor_name" data-live-search="true" >
                                                    <option value="">---SELECT---</option>
                                                    @foreach($customer as $customers)
                                                    <option value="{{$customers->id}}">{{$customers->name}}</option>
                                                    @endforeach
                                                </select></div>
                                                <!-- <button class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" id="add_button1" aria-expanded="false">
                                                <i class="flaticon2-plus"></i>Add Item
                                            </button> -->
                                        </div>
                                        <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Status</b></label>
                                        <div class="col-lg-9 col-xl-4">  
                                            <select class="form-control selectpicker" id="priority" name="priority" data-live-search="true" >
                                                <option value="">---SELECT---</option>
                                                <option value="Live">Live</option>
                                                <option value="Hold" >Hold</option>
                                                <option value="Cancle" >Cancel</option>
                                                <option value="Fabrication">Fabrication</option>
                                                <option value="Assembly">Assembly</option>
                                                <option value="FineFinishing">Fine Finishing</option>
                                                <option value="Packing">Packing</option>
                                                <option value="Dispatch">Dispatch</option>
                                            </select> 
                                        </div>
                                    </div>
                                        <table class="table table-striped" id="tb"><tr><th>Product Name</th><th>Description</th><th>Quantity</th><th>Unit Price</th><th>Total<button id="tb1" class="btn btn-brand btn-icon-sm" style="margin-left:25px;" aria-expanded="false">Add Product</button></th></tr>
                                        <tr><td><select class="form-control selectpicker" data-live-search="true" name="product_name[]"><option value="">---SELECT---</option>@foreach($tech as $datas)<option value="{{$datas->product_name}}">{{$datas->product_name}}</option>@endforeach</select></td><td><textarea class="form-control" name="description[]"></textarea></td><td><input class="form-control" type="number" name="quantity[]" id="quantity" oninput="getamountadd();"></td><td><input class="form-control" type="number" name="unit_price[]" id="unit_price" oninput="getamountadd();"></td><td><input class="form-control" type="number" id="total_price" name="total_price[]" readonly></td></tr></table>
                                        <div class="form-group row"></div>
                                        <table class="table col-xl-12 col-lg-12"><tr><th>Comments or Special Instructions:</th><td><textarea class="form-control" name="comments"></textarea></td></tr></table>
                                       <div class="form-group row">
                                            <div class="col-lg-6 col-xl-6">
                                                <table class="table"><tr><th>Expected Delivery Date</th><td>
                                                <input type="date" name="delivery_date" id="delivery_date" class="form-control" placeholder="Delivery Date"></td></tr></table>
                                            </div>
                                            <div class="col-lg-6 col-xl-6">
                                                <table class="table"><tr><th>Payment Terms</th><td>  
                                                <input type="text" name="payment_terms" id="payment_terms" class="form-control" placeholder="Payment Terms"></td></tr></table> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-xl-6">
                                                <table class="table">
                                                    <tr><th>Prepared By:</th><td><select class="form-control selectpicker" id="prepared_by" name="prepared_by" data-live-search="true">
                                                    <option value="">---SELECT---</option>
                                                    @foreach($user as $user1)
                                                    <option value="{{$user1->name}}">{{$user1->name}}</option>
                                                    @endforeach
                                            </select> </td></tr>
                                                </table>
                                            </div>
                                            <div class="col-lg-6 col-xl-6">
                                                <table class="table">
                                                    <tr><th>Approved By:</th><td><select class="form-control selectpicker" id="approved_by" name="approved_by" data-live-search="true">
                                                    <option value="">---SELECT---</option>
                                                     @foreach($user as $user1)
                                                    <option value="{{$user1->name}}">{{$user1->name}}</option>
                                                    @endforeach
                                            </select></td></tr>
                                                </table>
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
                                            <button type="submit" class="btn btn-success">Save</button>&nbsp;
                                            <a href="{{route('purchase.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
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
<script type="text/javascript">
 function getamount(itemCount1){
    var unit_price = $("#unit_price_"+itemCount1).val();
    var quantity = $("#quantity_"+itemCount1).val();
    $("#total_price_"+itemCount1).val(unit_price * quantity);
 }
 function getamountadd(){
    var unit_price = $("#unit_price").val();
    var quantity = $("#quantity").val();
    $("#total_price").val(unit_price * quantity);
 }
 $(document).ready(function(){
    var itemCount1 = 1;
    var wrapper = $("#tb");
    var add_button = $("#tb1");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<tr><td><select class="form-control" data-live-search="true" name="product_name[]"><option value="">---SELECT---</option>@foreach($tech as $datas)<option value="{{$datas->product_name}}">{{$datas->product_name}}</option>@endforeach</select></td><td><textarea class="form-control" name="description[]"></textarea></td><td><input class="form-control" type="number" name="quantity[]" id="quantity_'+itemCount1+'" oninput="getamount('+itemCount1+');"></td><td><input class="form-control" type="number" name="unit_price[]" id="unit_price_'+itemCount1+'" oninput="getamount('+itemCount1+');"></td><td><input class="form-control" type="number" name="total_price[]" id="total_price_'+itemCount1+'" readonly></td></tr>');
         $('select').selectpicker();
        itemCount1++;
    });
});
 function add(argument) {
     // body...
 }
</script>
@endsection



