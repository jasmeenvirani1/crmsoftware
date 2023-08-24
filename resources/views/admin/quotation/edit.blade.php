@extends('layouts.admin')
@section('content')
    <style>
        .invalid-feedback {
            color: #dc3545;
            /* Red color for error messages */
            display: block;
            /* Display each error message on a new line */
            font-size: 14px;
            /* Adjust the font size as needed */
            margin-top: 5px;
            /* Add a little spacing above the error message */
        }

        .text-left {
            text-align: left;
            /* Align the error message text to the left */
        }

        .alert {
            background-color: #f8d7da;
            /* Light red background for alert */
            border: 1px solid #f5c6cb;
            /* Border color for alert */
            color: #721c24;
            /* Text color for alert */
            padding: 8px;
            /* Padding for alert */
            border-radius: 4px;
            /* Rounded corners for alert */
            margin-top: 5px;
            /* Add spacing above the alert */
        }

        /* .alert strong {
                                                                                                                                                                                font-weight: bold;
                                                                                                                                                                            } */
    </style>
    <!-- begin:: Bradcrubs -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-link">
                        Dashboard </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ url('admin/vendors') }}" class="kt-subheader__breadcrumbs-link">
                        Vendors </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                        Update {{ $title }} </a>
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
                        {{-- @include('errormessage') --}}
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{ $title }}<small>{{ isset($data->id) ? 'Update' : 'Create' }} </small></h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">
                                        <a href="{{ route('vendors.index') }}" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Back
                                        </a>
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('vendors.store') }}" method="POST" id="create_category"
                                name="create_category" class="form-horizontal kt-form kt-form--label-right"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="process_type" value="update">
                                <input type="hidden" name="id" id="id"
                                    value="{{ isset($data->id) ? $data->id : '' }}">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"
                                                    style="font-size: 15px;"><b>Company Name</b><span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" maxlength="50" name="company_name"
                                                        value="{{ old('company_name', isset($data->companyname) ? $data->companyname : '') }}"
                                                        id="company_name" class="form-control" placeholder="Company Name">
                                                    @error('company_name')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>Address</b><span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <textarea maxlength="50" name="address" id="address" class="form-control"
                                                    placeholder="Address"
                                                    value="{{ old('address', isset($data->address) ? $data->address : '') }}"></textarea>
                                                @error('address')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>Registered Address</b><span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <textarea maxlength="50" name="registered_address" id="registered_address" class="form-control"
                                                    placeholder="Registered Address">{{ old('registered_address', isset($data->registered_address) ? $data->registered_address : '') }}</textarea>
                                                @error('registered_address')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>Registered Address GPS Location</b><span
                                                    class="text-danger"></span></label>
                                            <div class="col-lg-4 col-xl-3">
                                                <input type="text" maxlength="50" name="registered_address_latitude"
                                                    id="registered_address_latitude" class="form-control"
                                                    placeholder="Latitude"
                                                    value="{{ old('registered_address_latitude', isset($data->registered_address_latitude) ? $data->registered_address_latitude : '') }}">
                                                @error('registered_address_latitude')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-xl-3">
                                                <input type="text" maxlength="50" name="registered_address_longitude"
                                                    id="registered_address_longitude" class="form-control"
                                                    placeholder="Longitude"
                                                    value="{{ old('registered_address_longitude', isset($data->registered_address_longitude) ? $data->registered_address_longitude : '') }}">
                                                @error('registered_address_longitude')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>GST
                                                    IN</b><span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" name="gstin"
                                                    value="{{ old('gstin', isset($data->gst) ? $data->gst : '') }}"
                                                    id="gstin" class="form-control gst" placeholder="Gst Details">

                                                @error('gstin')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>Notes</b><span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <input type="text" maxlength="20" name="notes"
                                                    value="{{ old('notes', isset($data->notes) ? $data->notes : '') }}"
                                                    id="notes" class="form-control" placeholder="Notes">
                                                @error('notes')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>Plant Address</b><span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">
                                                <textarea maxlength="50" name="plant_address" id="plant_address" class="form-control" placeholder="Plant Address">{{ old('plant_address', isset($data->plant_address) ? $data->plant_address : '') }}</textarea>
                                                @error('plant_address')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>Plant Address GPS Location</b><span
                                                    class="text-danger"></span></label>
                                            <div class="col-lg-4 col-xl-2">
                                                <input type="text" maxlength="50" name="plant_address_latitude"
                                                    id="plant_address_latitude" class="form-control"
                                                    placeholder="Latitude"
                                                    value="{{ old('plant_address_latitude', isset($data->plant_address_latitude) ? $data->plant_address_latitude : '') }}">
                                            </div>
                                            <div class="col-lg-4 col-xl-2">
                                                <input type="text" maxlength="50" name="plant_address_longitude"
                                                    id="plant_address_longitude" class="form-control"
                                                    placeholder="Longitude"
                                                    value="{{ old('plant_address_longitude', isset($data->plant_address_longitude) ? $data->plant_address_longitude : '') }}">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>Billing Address</b><span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-4">

                                                <textarea maxlength="50" name="billing_address" id="billing_address" class="form-control"
                                                    placeholder="Plant Address">{{ old('billing_address', isset($data->billing_address) ? $data->billing_address : '') }}</textarea>

                                                @error('billing_address')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label"
                                                style="font-size: 15px;"><b>Billing Address GPS Location</b><span
                                                    class="text-danger"></span></label>
                                            <div class="col-lg-4 col-xl-2">
                                                <input type="text" maxlength="50" name="billing_address_latitude"
                                                    id="billing_address_latitude" class="form-control"
                                                    placeholder="Latitude"
                                                    value="{{ old('billing_address_latitude', isset($data->billing_address_latitude) ? $data->billing_address_latitude : '') }}">
                                                @error('billing_address_latitude')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 col-xl-2">
                                                <input type="text" maxlength="50" name="billing_address_longitude"
                                                    id="billing_address_longitude" class="form-control"
                                                    placeholder="Longitude"
                                                    value="{{ old('billing_address_longitude', isset($data->billing_address_longitude) ? $data->billing_address_longitude : '') }}">
                                                @error('billing_address_longitude')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div>
                                            <label class="col-xl-0 col-lg-0 col-form-label"
                                                style="font-size: 15px;margin-left: -10px;"><b>Contact
                                                    Details</b></label>
                                            <button class="btn btn-success add-contact mb-3" type="button">Add</button>
                                        </div>

                                        <div class="form-group">
                                            @foreach ($data->quotationDetails as $quotationDetails)
                                                <div class="form-group row">
                                                    <label class="col-xl-0 col-lg-0 col-form-label"><b>Name</b></label>
                                                    <div class="col-lg-2 col-xl-2">
                                                        <input type="text" maxlength="12" name="personmame[]"
                                                            class="form-control" value="{{ $quotationDetails->name }}">
                                                    </div>

                                                    <label class="col-xl-0 col-lg-0 col-form-label"><b>Phone</b></label>
                                                    <div class="col-lg-2 col-xl-2">
                                                        <input type="text" maxlength="12" name="phonenumber[]"
                                                            class="form-control allownumericwithoutdecimal"
                                                            value="{{ $quotationDetails->phone }}">
                                                    </div>
                                                    <label class="col-xl-0 col-lg-0 col-form-label"><b>Email</b></label>
                                                    <div class="col-lg-2 col-xl-2">
                                                        <input type="text" name="email[]" class="form-control"
                                                            value="{{ $quotationDetails->email }}">
                                                    </div>
                                                    <label
                                                        class="col-xl-0 col-lg-0 col-form-label"><b>Designation</b></label>
                                                    <div class="col-lg-2 col-xl-2">
                                                        <input type="text" name="designation[]" class="form-control"
                                                            value="{{ $quotationDetails->designation }}">
                                                    </div>
                                                    <button class="btn btn-danger  remove-row" id="btn_product_remove"
                                                        type="button">Remove</button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="increment form-group">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                                                                                                                                                                                                                                                                            </div> -->
                                    <!-- <div class="col-lg-5 col-xl-2">
                                                                                                                                                                                                                                                                                            </div> -->
                                    <!-- </div> -->
                                    <!-- <div class="form-group row" id="add_button">
                                                                                                                                                                                                                                                                                                <select class="form-control selectpicker" id="customer_name" name="customer_name" data-live-search="true">
                                                                                                                                                                                                                                                                                                    <option value="">---SELECT---</option>
                                                                                                                                                                                                                                                                                                    @foreach ($customer as $customers)
    <option value="{{ $customers->id }}" {{ $data->customer_name == $customers->id ? 'selected' : '' }}>{{ $customers->company_name }}</option>
    @endforeach
                                                                                                                                                                                                                                                                                        </div> -->
                                    <!-- <div class="form-group row">
                                                                                                                                                                                                                                                                                    </div>   -->
                                    {{-- </div>
                        </div> --}}
                                </div>
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3">
                                            </div>
                                            <div class="col-lg-9 col-xl-9">
                                                <button type="submit" class="btn btn-success">Save</button>&nbsp;
                                                <a href="{{ route('vendors.index') }}" id="cancel_btn"
                                                    class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="clone hidden d-none">
                                <div class="form-group">
                                    <div class="form-group row">
                                        <label class="col-xl-0 col-lg-0 col-form-label"><b>Name</b></label>
                                        <div class="col-lg-2 col-xl-2">
                                            <input type="text" maxlength="12" name="personmame[]"
                                                class="form-control">
                                        </div>
                                        <label class="col-xl-0 col-lg-0 col-form-label"><b>Phone</b></label>
                                        <div class="col-lg-2 col-xl-2">
                                            <input type="text" maxlength="12" name="phonenumber[]"
                                                class="form-control allownumericwithoutdecimal">
                                        </div>
                                        <label class="col-xl-0 col-lg-0 col-form-label"><b>Email</b></label>
                                        <div class="col-lg-2 col-xl-2">
                                            <input type="text" name="email[]" class="form-control">
                                        </div>
                                        <label class="col-xl-0 col-lg-0 col-form-label"><b>Designation</b></label>
                                        <div class="col-lg-2 col-xl-2">
                                            <input type="text" name="designation[]" class="form-control"
                                                value="">
                                        </div>
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger remove-row" type="button">Remove</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
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

        function table(that) {
            $(that).closest('table.trmv').remove()
        }

        $(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $(".add-contact").click(function() {
            var lsthmtl = $(".clone").html()
            $(".increment").append(lsthmtl);
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('.form-group').remove(); // Remove the closest parent form-group
        });
    </script>



    <script>
        $(document).ready(function() {
            // Initialize validation for existing and dynamically added rows
            $(document).on('focusout', '.form-group input', function() {
                $(this).valid();
            });
            // Validate and submit when the button is clicked
            $('#validateAndSubmit').click(function() {
                var isValid = true;

                // Loop through each dynamic form group
                $('.form-group').each(function(index) {
                    var group = $(this);
                    var validFields = group.find('input')
                        .valid(); // Validate fields within the group

                    if (!validFields) {
                        isValid = false;
                    }
                });

                // If all groups are valid, submit the form
                if (isValid) {
                    $('#yourForm').submit();
                }
            });
            // Initialize validation for the form
            $("#yourForm").validate({
                // Validation rules and messages
                rules: {
                    // ... your rules ...
                },
                messages: {
                    // ... your messages ...
                }
            });
        });
    </script>
@endsection
