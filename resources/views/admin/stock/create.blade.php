@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .image-update-admin {
            position: relative;
            margin: 8px 1rem;
            width: 100%;
        }
    </style>
    <?php
    $usdprice = DB::table('gst_percentage')
        ->select(DB::raw('cgst'))
        ->first();
    ?>
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
                    <a href="{{ url('admin/stock') }}" class="kt-subheader__breadcrumbs-link">
                        Product </a>
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

                        @include('errormessage')

                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                        {{ $title }}<small>{{ isset($data->id) ? 'Update' : 'Create' }} </small></h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">
                                        <a href="{{ route('stock.index') }}" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Back
                                        </a>
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('stock.store') }}" method="PUT" id="create_category"
                                name="create_category" class="form-horizontal kt-form kt-form--label-right"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id"
                                    value="{{ isset($data->id) ? $data->id : '' }}">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product Name</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="product_name" id="product_name"
                                                        class="form-control" placeholder="Product Name">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product
                                                        Image(s)</b></label>
                                                <div class="input-group demo control-group lst increment">
                                                    <input type="file" name="product_images[]"
                                                        class="col-xl-2 col-lg-2 form-control"  accept="image/png, image/jpeg" multiple>
                                                    {{-- <div class="input-group-btn">
                                                        <button class="btn btn-success products_img"
                                                            type="button">Add</button>
                                                    </div> --}}
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-9 col-xl-4 d-flex">
                                                        @if (isset($data->images))
                                                            <?php $i = 1;
                                                            ?>
                                                            @foreach ($data->images as $key => $img)
                                                                <div class="image-update-admin">
                                                                    <img style="height: 100px; width:100px;"
                                                                        id='blah{{ $i }}' alt="image"
                                                                        src="{{ asset('/product_image/' . $img) }}">
                                                                </div>
                                                                <?php $i++; ?>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="clone hide d-none">
                                                    <div class="demo control-group lst input-group" style="margin-top:10px">
                                                        <input type="file" name="filenames[]"
                                                            class="col-xl-2 col-lg-2 form-control">
                                                        <button class="btn btn-danger remove_btn"
                                                            type="button">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor
                                                        Image(s)</b></label>
                                                <div class="input-group demo1 control-group lst increment1 parth"
                                                    id="vendor_img_div">
                                                    <input type="file" name="vendor_images[]"
                                                        class="col-xl-2 col-lg-2 form-control" accept="image/png, image/jpeg" multiple>
                                                    {{-- <div class="input-group-btn">
                                                        <button class="btn btn-success id1" id="vendor_img"
                                                            type="button">Add</button>
                                                    </div> --}}
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-9 col-xl-4 d-flex">
                                                        @if (isset($data->vendorimage))
                                                            <?php $i = 1;
                                                            ?>
                                                            @foreach ($data->vendorimage as $key => $path)
                                                                <div class="image-update-admin">
                                                                    <input type="hidden" name="ifra" value="$path">
                                                                    <img style="height: 100px; width:100px;"
                                                                        id='blah{{ $i }}' alt="image"
                                                                        src="{{ asset('/vendor_image/' . $path) }}">
                                                                </div>
                                                                <?php $i++; ?>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-none" id="vendor_img_hide">
                                                    <div class="demo1 control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="file" name="filenamesvendor[]"
                                                            class="col-xl-2 col-lg-2 form-control">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-danger remove_btn"
                                                                type="button">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Client/Sales
                                                        Image(s)</b></label>
                                                <div class="input-group demo2 control-group lst increment2"
                                                    id="client_img_div">
                                                    <input type="file" name="client_images[]"
                                                        class="col-xl-2 col-lg-2 form-control" accept="image/png, image/jpeg" multiple>
                                                    {{-- <div class="input-group-btn">
                                                        <button class="btn btn-success id2 client_img"
                                                            type="button">Add</button>
                                                    </div> --}}
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-9 col-xl-4 d-flex">
                                                        @if (isset($data->clientimage))
                                                            <?php $i = 1;
                                                            ?>
                                                            @foreach ($data->clientimage as $key => $client)
                                                                <div class="image-update-admin">
                                                                    <img style="height: 100px; width:100px;"
                                                                        id='blah{{ $i }}' alt="image"
                                                                        src="{{ asset('/client_image/' . $client) }}">
                                                                </div>
                                                                <?php $i++; ?>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="d-none" id="client_img_hide">
                                                    <div class="demo2 control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="file" name="filenamesclient[]"
                                                            class="col-xl-2 col-lg-2 form-control">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-danger remove_btn"
                                                                type="button">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product
                                                        PartNo</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="partno"
                                                        value="{{ old('partno', isset($data->partno) ? $data->partno : '') }}"
                                                        id="partno" class="form-control" placeholder="Product PartNo">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Products
                                                        Category</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <select class="form-control" id="company_country"
                                                        name="company_country">
                                                        <option value="">SELECT</option>
                                                        @foreach ($category as $countries)
                                                            <option value="{{ $countries->name }}">{{ $countries->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product Dimension
                                                        :</b></label>
                                                <!-- <div class="col-lg-9 col-xl-2"> -->
                                                <label class="col-xl-1 col-lg-1 col-form-label"><b>Height</b></label>
                                                <input type="text" maxlength="12" name="product_dimension[]"
                                                    value="{{ old('product_dimension', isset($data->product_dimension[0]) ? $data->product_dimension[0] : '') }}"
                                                    id="product_dimension" class="col-xl-2 col-lg-2 form-control"
                                                    placeholder="Height">
                                                <label class="col-xl-1 col-lg-1 col-form-label"><b>Weight</b></label>
                                                <input type="text" maxlength="12" name="product_dimension[]"
                                                    value="{{ old('product_dimension', isset($data->product_dimension[1]) ? $data->product_dimension[1] : '') }}"
                                                    id="product_dimension" class="col-xl-2 col-lg-2 form-control"
                                                    placeholder="Weigth">
                                                <label class="col-xl-1 col-lg-1 col-form-label"><b>Length</b></label>
                                                <input type="text" maxlength="12" name="product_dimension[]"
                                                    value="{{ old('product_dimension', isset($data->product_dimension[2]) ? $data->product_dimension[2] : '') }}"
                                                    id="product_dimension" class="col-xl-2 col-lg-2 form-control"
                                                    placeholder="Length">
                                                <label class="col-xl-1 col-lg-1 col-form-label"><b>Bridth</b></label>
                                                <input type="text" maxlength="12" name="product_dimension[]"
                                                    value="{{ old('product_dimension', isset($data->product_dimension[3]) ? $data->product_dimension[3] : '') }}"
                                                    id="product_dimension" class="col-xl-2 col-lg-2 form-control"
                                                    placeholder="Bridth">
                                                <label class="col-xl-1 col-lg-1 col-form-label"><b>Depth</b></label>
                                                <input type="text" maxlength="12" name="product_dimension[]"
                                                    value="{{ old('product_dimension', isset($data->product_dimension[4]) ? $data->product_dimension[4] : '') }}"
                                                    id="product_dimension" class="col-xl-2 col-lg-2 form-control"
                                                    placeholder="Depth">
                                                <label class="col-xl-1 col-lg-1 col-form-label"><b>Radius</b></label>
                                                <input type="text" maxlength="12" name="product_dimension[]"
                                                    value="{{ old('product_dimension', isset($data->product_dimension[5]) ? $data->product_dimension[5] : '') }}"
                                                    id="product_dimension" class="col-xl-2 col-lg-2 form-control"
                                                    placeholder="Radius">
                                                <label class="col-xl-1 col-lg-1 col-form-label"><b>Thickness</b></label>
                                                <input type="text" maxlength="12" name="product_dimension[]"
                                                    value="{{ old('product_dimension', isset($data->product_dimension[6]) ? $data->product_dimension[6] : '') }}"
                                                    id="product_dimension" class="col-xl-2 col-lg-2 form-control"
                                                    placeholder="Thickness">
                                                <!-- </div> -->
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product
                                                        Company</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="product_company"
                                                        value="{{ old('product_company', isset($data->product_company) ? $data->product_company : '') }}"
                                                        id="product_company" class="form-control"
                                                        placeholder="Product Company">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="product_size"
                                                        value="{{ old('product_size', isset($data->product_size) ? $data->product_size : '') }}"
                                                        id="product_size" class="form-control" placeholder="Vendor">
                                                </div>
                                            </div>
                                            <div class="form-group row" id="productprice">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Products
                                                        Price</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" pattern="\d*" maxlength="5"
                                                        name="product_price"
                                                        value="{{ old('product_price', isset($data->product_price) ? $data->product_price : '') }}"
                                                        id="productprice" class="form-control allownumericwithoutdecimal"
                                                        placeholder="Product Price(INR)">
                                                </div>
                                            </div>

                                            <div class="form-group row ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>product price in usd
                                                    </b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="total_amount" id="total_amount"
                                                        class="form-control " readonly />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product Specification
                                                    </b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="specification"
                                                        value="{{ old('notes', isset($data->notes) ? $data->notes : '') }}"
                                                        id="specification" class="form-control "
                                                        placeholder="Product Specification">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product
                                                        Notes</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="notes"
                                                        value="{{ old('notes', isset($data->notes) ? $data->notes : '') }}"
                                                        id="notes" class="form-control" placeholder="Product Notes">
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Products Inward Qty.</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="inward_qty" value="{{ old('inward_qty', isset($data->inward_qty) ? $data->inward_qty : '') }}" id="inward_qty" class="form-control" placeholder="Qty.">
                                                </div>
                                            </div> -->
                                            <!-- <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Outward Qty.</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="outward_qty" value="{{ old('outward_qty', isset($data->outward_qty) ? $data->outward_qty : '') }}" id="outward_qty" class="form-control" placeholder="Qty">
                                                </div>
                                            </div> -->
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
                                                <a href="{{ route('stock.index') }}" id="cancel_btn"
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
        var st_km = "<?php echo $usdprice->cgst; ?>";
        $(document).ready(function() {
            $.validator.addMethod("alpha", function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
            }, "Letters only please");
            $(".products_img").click(function() {
                console.log("product");
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click", ".remove_btn", function() {
                $(this).parents(".demo").remove();
            });
            $("#vendor_img").click(function() {
                console.log("Hello")
                var lsthmtl1 = $("#vendor_img_hide").html();
                $("#vendor_img_div").after(lsthmtl1);
            });
            $("body").on("click", ".remove_btn", function() {
                $(this).parents(".demo1").remove();
            });
            $(".client_img").click(function() {
                console.log("client_img");
                var lsthmtl2 = $("#client_img_hide").html();
                $("#client_img_div").after(lsthmtl2);
            });
            $("body").on("click", ".remove_btn", function() {
                $(this).parents(".demo2").remove();
            });

        });

        $(".allownumericwithoutdecimal").on("keypress keyup blur", function(event) {

            document.getElementById("total_amount").value = $(this).val() * st_km;

            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
    </script>
@endsection
