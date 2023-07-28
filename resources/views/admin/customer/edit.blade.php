@extends('layouts.admin')
@section('content')
<style type="text/css">
    .image-update-admin {
        position: relative;
        margin: 8px 1rem;
        width: 100%;
    }
</style>
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
                <a href="{{url('admin/customer')}}" class="kt-subheader__breadcrumbs-link">
                    Customer </a>   
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
                                    <a href="{{route('customer.index')}}" class="btn btn-clean btn-icon-sm">
                                        <i class="la la-long-arrow-left"></i>
                                        Back
                                    </a>
                                    &nbsp;                      
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('customereditstore') }}" method="POST" id="create_category" name="create_category"  class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                            @csrf                    
                            <input type="hidden" name="id"  id="id" value="{{isset($data->id) ? $data->id: ''}}">
                            <div class="kt-portlet__body">
                            <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"><b>Contact Details</hiiib></label>
                                            <div class="input-group demo control-group lst increment">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Companyname</b></label>
                                                <input type="text" maxlength="12" name="companyname[]" class="col-xl-2 col-lg-2 form-control">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Email</b></label>
                                                <input type="text"  name="email[]" class="col-xl-2 col-lg-2 form-control">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Phone Number</b></label>
                                                <input type="text" maxlength="10" name="phonenumber[]" class="col-xl-2 col-lg-2 form-control allownumericwithoutdecimal">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Address</b></label>
                                                <input type="text" maxlength="50" name="address[]" class="col-xl-2 col-lg-2 form-control ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Gst in</b></label>
                                                <input type="file" maxlength="50" name="gst[]" class="col-xl-2 col-lg-2 form-control ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Pan card</b></label>
                                                <input type="file" maxlength="50" name="pancard[]" class="col-xl-2 col-lg-2 form-control ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Cheque</b></label>
                                                <input type="file" maxlength="50" name="cheque[]" class="col-xl-2 col-lg-2 form-control ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>MSME Certificate</b></label>
                                                <input type="file" maxlength="50" name="certificate" class="col-xl-2 col-lg-2 form-control ">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-success products_img" type="button">Add</button>
                                                </div>
                                            </div>
                                            <div class="clone hidden d-none">
                                                <div class="demo control-group lst input-group" style="margin-top:10px">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Companyname</b></label>
                                                <input type="text" maxlength="12" name="companyname[]" class="col-xl-2 col-lg-2 form-control">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Email</b></label>
                                                <input type="text"  name="email[]" class="col-xl-2 col-lg-2 form-control">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b> Phone Number</b></label>
                                                <input type="text" maxlength="10" name="phonenumber[]" class="col-xl-2 col-lg-2 form-control allownumericwithoutdecimal">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Address</b></label>
                                                <input type="text" maxlength="12" name="address[]" class="col-xl-2 col-lg-2 form-control ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Gst in</b></label>
                                                <input type="file" maxlength="50" name="gst[]" class="col-xl-2 col-lg-2 form-control ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Pan card</b></label>
                                                <input type="file" maxlength="50" name="pancard[]" class="col-xl-2 col-lg-2 form-control ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Cheque</b></label>
                                                <input type="file" maxlength="50" name="cheque[]" class="col-xl-2 col-lg-2 form-control ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>MSME Certificate</b></label>
                                                <input type="file" maxlength="50" name="certificate" class="col-xl-2 col-lg-2 form-control ">
                                                    <button class="btn btn-danger remove_btn" type="button">Remove</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if($data->name)
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->name as $key=>$path)
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>CompanyName</b></label>
                                                <input type="text" name="companyname[]"value="{{old('personmame',isset($path)?$path:'')}}" class="col-xl-2 col-lg-2 form-control">
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if($data->email)
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->email as $key=>$path)
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Email</b></label>
                                                <input type="text" name="email[]"value="{{old('email',isset($path)?$path:'')}}" class="col-xl-2 col-lg-2 form-control">
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if($data->phonenumber)
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->phonenumber as $key=>$path)
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>phoneNumber</b></label>
                                                <input type="text" name="phonenumber[]"value="{{old('phonenumber',isset($path)?$path:'')}}" class="col-xl-2 col-lg-2 form-control">
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if($data->address)
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->address as $key=>$path)
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Address</b></label>
                                                <input type="text" name="phonenumber[]"value="{{old('phonenumber',isset($path)?$path:'')}}" class="col-xl-2 col-lg-2 form-control">
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="form-group row">
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if(isset($data->gst))
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->gst as $key=>$path)
                                                <div class="image-update-admin">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Gst</b></label>

                                                    <input type ="hidden" name="ifra" value="$path">
                                                    <img style="height: 100px; width:100px;" id='blah{{$i}}' alt="image" src="{{asset('/gst/'.$path)}}">
                                                </div>
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if(isset($data->pancard))
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->pancard as $key=>$path)
                                                <div class="image-update-admin">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Pancard</b></label>
                                                    <input type ="hidden" name="ifra" value="$path">
                                                    <img style="height: 100px; width:100px;" id='blah{{$i}}' alt="image" src="{{asset('/pancard/'.$path)}}">
                                                </div>
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-9 col-xl-4 d-flex">
                                            @if(isset($data->cheque))
                                                <?php $i = 1;
                                                 ?>
                                                @foreach($data->cheque as $key=>$path)
                                                <div class="image-update-admin">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Cheque</b></label>
                                                    <input type ="hidden" name="ifra" value="$path">
                                                    <img style="height: 100px; width:100px;" id='blah{{$i}}' alt="image" src="{{asset('/cheque/'.$path)}}">
                                                </div>
                                                <?php $i++; ?>
                                                @endforeach
                                                @endif
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
                                            <a href="{{route('customer.index')}}" id="cancel_btn" class="btn btn-secondary">Cancel</a>
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
