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
                    <a href="{{ url('admin/customer') }}" class="kt-subheader__breadcrumbs-link">
                        Company </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                        Add {{ $title }} </a>
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
                                        <a href="{{ route('company.index') }}" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Back
                                        </a>
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('company.store') }}" method="POST" id="create_category"
                                name="create_category" class="form-horizontal kt-form kt-form--label-right"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id"
                                    value="{{ isset($data->id) ? $data->id : '' }}">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group">
                                                <label><b>Contact Details</b></label>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label required">
                                                    <b>Company Name</b>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="text" name="vendor_company_name"
                                                        value="{{ old('vendor_company_name', isset($data->vendor_company_name) ? $data->vendor_company_name : '') }}"
                                                        id="vendor_company_name" class="form-control"
                                                        placeholder="Company Name">
                                                    @error('vendor_company_name')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label required">
                                                    <b>Email</b>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="email" name="email"
                                                        value="{{ old('email', isset($data->vendor_company_name) ? $data->vendor_company_name : '') }}"
                                                        id="vendor_company_name" class="form-control" placeholder="Email">
                                                    @error('email')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label required">
                                                    <b>Phone Number</b>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="text" name="phonenumber"
                                                        value="{{ old('phonenumber', isset($data->vendor_company_name) ? $data->vendor_company_name : '') }}"
                                                        id="vendor_company_name" class="form-control"
                                                        placeholder="Phone Number">
                                                    @error('phonenumber')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label required">
                                                    <b>Address</b>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="text" name="address"
                                                        value="{{ old('address', isset($data->vendor_company_name) ? $data->vendor_company_name : '') }}"
                                                        id="vendor_company_name" class="form-control" placeholder="Address">
                                                    @error('address')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>GST</b>
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="text" name="gst" id="gst"
                                                        class="form-control" placeholder="GST">
                                                    @error('gst')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label required">
                                                    <b>Logo</b>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="file" name="logo" class="form-control"
                                                        placeholder="Logo" accept="image/png, image/jpeg" required>
                                                    @error('logo')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Pan Card</b></label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="file" name="pancard" class="form-control"
                                                        placeholder="GST" accept="image/png, image/jpeg">
                                                    @error('pancard')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Cheque</b></label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="file" name="cheque" class="form-control"
                                                        placeholder="Cheque" accept="image/png, image/jpeg">
                                                    @error('cheque')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>MSME
                                                        Certificate</b></label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="file" name="msme" class="form-control"
                                                        placeholder="MSME Certificate" accept="image/png, image/jpeg">
                                                    @error('msme')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror

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
                                                <button type="submit"
                                                    class="btn btn-success">{{ $btn }}</button>&nbsp;
                                                <a href="{{ route('company.index') }}" id="cancel_btn"
                                                    class="btn btn-secondary">Cancel</a>
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
        });
    </script>
@endsection
