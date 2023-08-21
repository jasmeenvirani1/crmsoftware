@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .image-update-admin {
            position: relative;
            margin: 8px 1rem;
            width: 100%;
        }

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

                        {{-- @include('errormessage') --}}

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
                            <form action="{{ route('stock.store') }}" method="POST" id="create_category"
                                name="create_category" class="form-horizontal kt-form kt-form--label-right"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id"
                                    value="{{ isset($data->id) ? $data->id : '' }}">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product Name</b>
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="product_name" id="product_name"
                                                        class="form-control" placeholder="Product Name">
                                                    @error('product_name')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product
                                                        Image(s)</b><span class="text-danger">*</span></label></label>

                                                <div class="input-group demo control-group lst increment">
                                                    <input type="file" name="product_images[]"
                                                        class="col-xl-2 col-lg-2 form-control"
                                                        accept="image/png, image/jpeg" multiple required>
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

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Vendor
                                                        Image(s)</b><span class="text-danger">*</span></label>
                                                <div class="input-group demo1 control-group lst increment1 parth"
                                                    id="vendor_img_div">
                                                    <input type="file" name="vendor_images[]"
                                                        class="col-xl-2 col-lg-2 form-control"
                                                        accept="image/png, image/jpeg" multiple required>
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
                                                        Image(s)</b><span class="text-danger">*</span></label>
                                                <div class="input-group demo2 control-group lst increment2"
                                                    id="client_img_div">
                                                    <input type="file" name="client_images[]"
                                                        class="col-xl-2 col-lg-2 form-control"
                                                        accept="image/png, image/jpeg" multiple required>
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
                                                        PartNo</b><span class="text-danger">*</span></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="partno"
                                                        value="{{ old('partno', isset($data->partno) ? $data->partno : '') }}"
                                                        id="partno" class="form-control" placeholder="Product PartNo">
                                                    @error('partno')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Products
                                                        Category</b><span class="text-danger">*</span></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <select class="form-control" id="company_country"
                                                        name="company_country">
                                                        <option value="">SELECT</option>
                                                        @foreach ($category as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('company_country')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Minimum Order Quantity
                                                    </b><span class="text-danger">*</span></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="minqty"
                                                        value=""
                                                        id="minqty" class="form-control" placeholder="Minimum Order Quantity">
                                                    {{-- @error('minqty')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong></span>
                                                    @enderror --}}
                                                </div>
                                            </div>


                                            <label class="col-xl-0 col-lg-0 col-form-label"
                                                style="font-size: 15px;margin-left: -10px;"><b>Product Dimension
                                                    :</b></label>
                                            <button class="btn btn-success add-contact mb-3" type="button"
                                                style="float: right;">Add
                                                Dimension</button>


                                            <div class="card-body">
                                                @php
                                                    $quantitiesValues = config('const.quantities');
                                                    $default_product_dimension = config('const.default_product_dimension');
                                                @endphp
                                                <!--begin: Datatable-->
                                                <table
                                                    class="table table-separate table-head-custom table-checkable border"
                                                    id="stock_datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>Dimension Name</th>
                                                            <th>Dimension Value</th>
                                                            <th>Quantities Value</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="DimensionBody">
                                                        @foreach ($default_product_dimension as $product_dimension)
                                                            <tr>
                                                                <td><input type="text" maxlength="12"
                                                                        name="dimension_name[]"
                                                                        class="col-xl-6 col-lg-6  form-control"
                                                                        placeholder="Dimension Name"
                                                                        value="{{ $product_dimension['dimension_name'] }}"
                                                                        readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" maxlength="12"
                                                                        name="dimension_value[]"
                                                                        class="col-xl-6 col-lg-6  form-control"
                                                                        placeholder="Dimension Value"
                                                                        value="{{ $product_dimension['dimension_value'] }}">

                                                                </td>
                                                                <td>
                                                                    <select name="quantities_value[]"
                                                                        class="col-xl-6 col-lg-6  form-control">
                                                                        @foreach ($quantitiesValues as $quantitie)
                                                                            <option value="{{ $quantitie }}"
                                                                                @if ($quantitie == $product_dimension['quantities_value']) selected @endif>
                                                                                {{ $quantitie }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-danger remove-row"
                                                                        type="button">Remove</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <!--end: Datatable-->
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

                                                    <select class="form-control selectpicker" data-live-search="true"
                                                        id="vendor_name" name="vendors[]" multiple>
                                                        <option value="">---SELECT---</option>
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{ $vendor->id }}">
                                                                {{ $vendor->companyname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="productprice">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product Price (In
                                                        INR.)</b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" pattern="\d*" maxlength="5"
                                                        name="product_price"
                                                        value="{{ old('product_price', isset($data->product_price) ? $data->product_price : '') }}"
                                                        id="productprice" class="form-control allownumericwithoutdecimal"
                                                        placeholder="Product Price(INR)">
                                                </div>
                                            </div>

                                            <div class="form-group row ">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Product Price (In USD
                                                        $.)
                                                    </b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="total_amount" id="total_amount"
                                                        class="form-control " readonly />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Corporate Price
                                               </b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="notes"
                                                        value=""
                                                        id="notes" class="form-control" placeholder="Corporate Price">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Retail Price
                                               </b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="notes"
                                                        value=""
                                                        id="notes" class="form-control" placeholder="Retail Price">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Dealer Price
                                               </b></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="notes"
                                                        value=""
                                                        id="notes" class="form-control" placeholder="Dealer Price">
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
    <div class="hidden d-none">
        <table> <!-- Add a table tag here -->
            <tbody class="clone"> <!-- Add a tbody tag here -->
                <tr>
                    <td>
                        <input type="text" maxlength="12" name="dimension_name[]" id="product_dimension"
                            class="col-xl-6 col-lg-6  form-control" placeholder="Dimension Name">
                    </td>
                    <td>
                        <input type="text" maxlength="12" name="dimension_value[]" id="product_dimension"
                            class="col-xl-6 col-lg-6  form-control" placeholder="Dimension Value">
                    </td>
                    <td>
                        <select name="quantities_value[]" class="col-xl-6 col-lg-6  form-control">
                            @foreach ($quantitiesValues as $quantitie)
                                <option>{{ $quantitie }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-danger remove-row" type="button">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
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

            var product_price = $(this).val() / st_km;
            var rounded_price = product_price.toFixed(2); // Round to two decimal places

            document.getElementById("total_amount").value = rounded_price;

            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        $(".add-contact").click(function() {
            var lsthmtl = $(".clone").html();
            console.log(lsthmtl);
            $("#DimensionBody").append(lsthmtl);
        });


        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    </script>
@endsection
