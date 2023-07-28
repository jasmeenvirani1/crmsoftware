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
                <a href="{{url('admin/terms')}}" class="kt-subheader__breadcrumbs-link">
                    Terms </a>   
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
                                    <a href="{{route('terms.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('terms.store') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Title</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <input type="text" name="title" value="{{old('title',isset($data->title)?$data->title:'')}}" id="title" class="form-control" placeholder="Title" required> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Description</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">  
                                                <textarea name="description" id="description" class="form-control" placeholder="description"required>{{old('description',isset($data->description)?$data->description:'')}}</textarea> 
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
                                            <a href="{{route('terms.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
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
<script>
$(document).ready(function() {
        $('#company_country').on('change', function() {
                            var country_id = this.value;
                            $("#company_state").html('');
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
                            $("#company_state").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                            $('#company_city').html('<option value="">Select State First</option>'); 
                            }
                    });
                });    
                                 $('#company_state').on('change', function() {
                                                var state_id = this.value;
                                                $("#company_city").html('');
                                        $.ajax({
                                                    url:"{{url('get-cities-by-state')}}",
                                                    type: "POST",
                                                    data: {
                                                    state_id: state_id,
                                                    _token: '{{csrf_token()}}'
                                                    },
                                                    dataType : 'json',
                                                    success: function(result){
                                                    $('#company_city').html('<option value="">Select City</option>'); 
                                                    $.each(result.cities,function(key,value){
                                                    $("#company_city").append('<option value="'+value.id+'">'+value.name+'</option>');
                                                    });
                                                }
                                            });
                                        });
                        });
</script>
@endsection
