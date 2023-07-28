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
                <a href="{{url('admin/stock')}}" class="kt-subheader__breadcrumbs-link">
                    Stock </a>   
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                    View {{$title}} </a>   
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
                                 @foreach($data2 as $demo2)
                                <h3 class="kt-portlet__head-title">{{$title}}<small>{{$demo2->product_name}}</small></h3>
                                @endforeach
                            </div>
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <table class="table table-striped">
                               <!--  @foreach($data2 as $demo2)
                                <tr><th colspan="5">{{$demo2->product_name}}</th></tr>
                                @endforeach -->
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Date</th>
                                    <th>Vendor Name</th>
                                    <th>Inward Qty.</th>
                                    <th>Outward Qty.</th>
                                    <th>Price</th>
                                    <th>PO No.</th>
                                    <th>Balance</th>    
                                </tr>
                                <?php $i=1; ?>
                                @foreach($data as $demo)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{date('d M Y', $demo->created_at->timestamp)}}</td>
                                    <!-- <td>{{$demo->created_at}}</td> -->
                                    <td>{{$demo->vendor_name}}</td>
                                    <td>{{$demo->inward_qty}}</td>
                                    <td>{{$demo->outward_qty}}</td>
                                    <td>{{$demo->product_price}}</td>
                                    <td>{{$demo->po_no}}</td>
                                    <td>{{$demo->balanced_qty}}</td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                                @foreach($data1 as $demo1)
                                <tr>
                                    <td colspan="7"><b>Total Current Balance</b></td>
                                    <td><b>{{$demo1->balanced_qty}}</b></td>
                                </tr>
                                @endforeach
                            </table>
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
    $(document).ready(function () {
        $.validator.addMethod("alpha", function (value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
        }, "Letters only please");
    });
</script>
@endsection
