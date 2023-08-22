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

        .image-update-admin {
            position: relative;
            margin: 8px 1rem;
            width: 100%;
        }

        .img-wrap {
            position: relative;
            ...
        }

        .image-delete-button {
            display: inline-block;
            height: 20px;
            background-color: red;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .remove-image {
            cursor: pointer;
            display: none;
            position: absolute;
            top: -10px;
            /* right: -10px; */
            border-radius: 10em;
            padding: 3px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }

        .remove-image:hover {
            background: #E54E4E;
            padding: 4px 7px 5px;
            top: -11px;
            /* right: -11px; */
        }

        /* .remove-image:active {
                                background: #E54E4E;
                                top: -10px;
                                right: -11px;
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
                                        {{-- {{ route('detail', ['id' => $data->id]) }} --}}
                                        <a href="{{ route('detail', ['id' => $data->id]) }}" target="_blank"
                                            class="btn btn-success">Export
                                            To PDF</a>
                                        <a href="{{ route('company.index') }}" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Back
                                        </a>
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('company.update', ['company' => $data->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group">
                                                <label><b>Contact Details</b></label>
                                            </div>
                                            <div class="col-lg-6 col-xl-4">

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label required">
                                                    <b>Company Name</b>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="text" name="vendor_company_name"
                                                        value="{{ $data->name }}" id="vendor_company_name"
                                                        class="form-control" placeholder="Company Name">
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
                                                    <input type="email" name="email" value="{{ $data->email }}"
                                                        id="email" class="form-control" placeholder="Email">
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
                                                        value="{{ $data->phonenumber }}" id="phonenumber"
                                                        class="form-control" placeholder="Phone Number">
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
                                                    <input type="text" name="address" value="{{ $data->address }}"
                                                        id="address" class="form-control" placeholder="Address">
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
                                                        class="form-control" placeholder="GST"
                                                        value="{{ $data->gst }}">
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
                                                        placeholder="Logo" accept="image/png, image/jpeg">
                                                </div>
                                                <img src="{{ asset($data->logo) }}" style="height: 77px;width: 110px;">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Pan Card</b></label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="file" name="pancard" class="form-control"
                                                        placeholder="GST" accept="image/png, image/jpeg">
                                                </div>
                                                <img src="{{ asset($data->pancard) }}"
                                                    style="height: 77px;width: 110px;">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Cheque</b></label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="file" name="cheque" class="form-control"
                                                        placeholder="Cheque" accept="image/png, image/jpeg">
                                                </div>
                                                <img src="{{ asset($data->cheque) }}" style="height: 77px;width: 110px;">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>MSME
                                                        Certificate</b></label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="file" name="msme" class="form-control"
                                                        placeholder="MSME Certificate" accept="image/png, image/jpeg">
                                                </div>
                                                <img src="{{ asset($data->msme_certificate) }}"
                                                    style="height: 77px;width: 110px;">

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Extra
                                                        Image(s)</b></label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <input type="file" name="extra_images[]" class="form-control"
                                                        placeholder="" accept="image/png, image/jpeg" multiple>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-9 col-xl-4 d-flex">

                                                    @foreach ($data->extraImage as $extra_image)
                                                        <div
                                                            class="position-relative image-customer_extra_images-{{ $extra_image->id }}">

                                                            <div class="img-wrap">
                                                                <span class="remove-image"
                                                                    data-id="{{ $extra_image->id }}" title="Delete"
                                                                    data-type="customer_extra_images"
                                                                    style="display: inline;">×</span>
                                                                <img style="height: 100px; width:100px;"
                                                                    src="{{ asset($extra_image->image) }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label required">
                                                    <b>Notes</b>
                                                </label>
                                                <div class="col-lg-6 col-xl-4">
                                                    <textarea name="notes" value="" id="notes" class="form-control" placeholder="Notes">{{ $data->notes }}</textarea>
                                                    @error('notes')
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


            $(".remove-image").click(function() {
                var id = $(this).data('id');
                var type = $(this).data('type');
                var formData = new FormData();
                formData.append('id', id);
                formData.append('type', type);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('customer.image.delete') }}",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            var selector = '.image-' + type + '-' + id;
                            $(selector).remove()
                        }
                    },
                    error: function(request, status, error) {
                        alert('Something went wrong');
                    }
                });
            });
        });
    </script>
@endsection
