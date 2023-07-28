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
                    Add TechnicalSpecification </a>   
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
                                <h3 class="kt-portlet__head-title"><small></small></h3>
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
                                                <input type="text" name="product_name" value="{{old('product_name',isset($data->product_name)?$data->product_name:'')}}" id="product_name" class="form-control" placeholder="product_name" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>External Dimension</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-3 col-xl-3">  
                                                <input type="number" name="external_dimension[]" id="external_dimension1" class="form-control" value="{{$data->external_dimension[0]}}" placeholder="Width" required>
                                            </div>
                                            <div class="col-lg-3 col-xl-3">  
                                                <input type="number" name="external_dimension[]" id="external_dimension2" class="form-control" value="{{$data->external_dimension[1]}}" placeholder="Depth" required> 
                                            </div>
                                            <div class="col-lg-3 col-xl-3">  
                                                <input type="number" name="external_dimension[]" id="external_dimension3" class="form-control" value="{{$data->external_dimension[2]}}" placeholder="Height" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row" id="ts1">
                                            <label class="col-xl-3 col-lg-3 col-form-label" style="font-size: 15px;"><b>Technical Specification</b></label>
                                            <button class="btn btn-brand btn-icon-sm col-xl-2 col-lg-2" id="ts" aria-expanded="false">
                                                <i class="flaticon2-plus"></i>Add Item
                                            </button>
                                        </div>
                                        @if($data->title != '')
                                        <?php 
                                        $countfiles = count($data->title);?>
                                        <?php $i=0; ?>
                                        @for($j=0; $j<$countfiles; $j++)
                                        <table class="col-xl-12 col-lg-12 table table-striped" border="2">
                                            <tr>
                                                <th><label class="col-form-label"><b>Title</b></label></th>
                                                <td><input type="text" name="title[]" value="{{old('title',isset($data->title[$i])?$data->title[$i]:'')}}" class="form-control"  required></td>
                                            </tr>
                                            <tr>
                                                <th><label class="col-form-label"><b>Description</b></label></th>
                                                <td><textarea class="form-control" name="details[]" 
                                                    required>{{old('details',isset($data->details[$i])?$data->details[$i]:'')}}</textarea></td>
                                            </tr>
                                        </table>
                                        <?php $i++; ?>
                                        @endfor
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-success">Update</button>&nbsp;
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
    var wrapper = $("#ts1");
    var add_button = $("#ts");
    $(add_button).click(function(e){
        e.preventDefault();
        $(wrapper).append('<table class="col-xl-12 col-lg-12 table table-striped" border="2"><tr><th><label class="col-form-label"><b>Title</b></label></th><td><input type="text" name="title[]" class="form-control"  required></td></tr><tr><th><label class="col-form-label"><b>Description</b></label></th><td><textarea class="form-control" name="details[]"  required></textarea></td></tr></table>');

        });
});
</script>
@endsection
