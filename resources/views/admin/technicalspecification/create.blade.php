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
                <a href="{{url('admin/technicalspecification')}}" class="kt-subheader__breadcrumbs-link">
                    TechnicalSpecification </a>   
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
                                    <a href="{{route('technicalspecification.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('technicalspecification.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                        @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Product Name</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="product_name" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>External Dimension</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-3 col-xl-3">  
                                                <input type="number" name="external_dimension[]" id="external_dimension1" class="form-control" placeholder="Width" required> 
                                            </div>
                                            <div class="col-lg-3 col-xl-3">  
                                                <input type="number" name="external_dimension[]" id="external_dimension2" class="form-control" placeholder="Depth" required> 
                                            </div>
                                            <div class="col-lg-3 col-xl-3">  
                                                <input type="number" name="external_dimension[]" id="external_dimension3" class="form-control" placeholder="Height" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row" id="ts1">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Technical Specification</b><span class="text-danger">*</span></label>
                                            <button id="ts" class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" aria-expanded="false">
                                                        <i class="flaticon2-plus"></i>Add
                                                    </button>
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
                                            <a href="{{route('technicalspecification.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
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
    var itemCount = 1;
    var wrapper = $(".Add");
    var add_button = $("#Data");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<table class="col-xl-12 col-lg-12 table table-striped" border="2"><tr><th><label class="col-form-label"><b>Internal Dimension</b></label></th><td><label class="col-form-label"><b>Height</b></label></td><td><input type="number" name="i_d_height[]" class="form-control"  required></td><td><label class="col-form-label"><b>Width</b></label></td><td><input type="number" name="i_d_width[]" class="form-control" required></td><td><label class="col-form-label"><b>Depth</b></label></td><td><input type="number" name="i_d_depth[]" class="form-control" required></td></tr><tr><th><label class="col-form-label"><b>External Dimension</b></label></th><td><label class="col-form-label"><b>Height</b></label></td><td><input type="number" name="e_d_height[]" class="form-control"  required></td><td><label class="col-form-label"><b>Width</b></label></td><td><input type="number" name="e_d_width[]" class="form-control" required></td><td><label class="col-form-label"><b>Depth</b></label></td><td><input type="number" name="e_d_depth[]" class="form-control"  required></td></tr><tr><td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>HSN/SAC Code</b></label></td><td colspan="4"><input type="number" name="h_s_code[]" class="form-control" required></td></tr><tr><td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Unit Price(INR)</b></label></td><td colspan="4"><input type="number" name="unit_price[]" id="unit_price_'+itemCount+'" class="form-control" oninput="getamount('+itemCount+');" required></td></tr><tr><td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Quantity</b></label></td><td colspan="4"><input type="number" id="quantity_'+itemCount+'" name="quantity[]" class="form-control" oninput="getamount('+itemCount+');"  required></td></tr><tr><td colspan="3"><label class="col-xl-3 col-lg-3 col-form-label"><b>Total Price</b></label></td><td colspan="4"><input type="number" name="total_price[]" id="total_price_'+itemCount+'" class="form-control" readonly></td></tr></table>');
        itemCount++;
    });

});
</script>
<script type="text/javascript">
$(document).ready(function(){
    var wrapper = $("#ts1");
    var add_button = $("#ts");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<table class="col-xl-12 col-lg-12 table table-striped" border="2">                <tr><th><label class="col-form-label"><b>Title</b></label></th><td><input type="text" name="title[]" class="form-control"  required></td></tr><tr><th><label class="col-form-label"><b>Description</b></label></th><td><textarea class="form-control" name="details[]"  required></textarea></td></tr></table>');

        });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    var wrapper = $("#add_button");
    var add_button = $("#add_button1");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<table class="col-xl-12 col-lg-12 table table-striped" border="2"><tr><th>Customer Name</th><td><input type="text" name="customer_name[]" class="form-control" placeholder="New Customer" required></td></tr></table>');

        });
});
</script>
<script type="text/javascript">
 function getamount(itemCount){
    var unit_price = $("#unit_price_"+itemCount).val();
    var quantity = $("#quantity_"+itemCount).val();
    $("#total_price_"+itemCount).val(unit_price * quantity);
 }
</script>
@endsection
