@extends('layouts.admin')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
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
                    <a href="{{url('admin/vendor')}}" class="kt-subheader__breadcrumbs-link">
                        {{$title}} </a>               
                </div>
            </div>         
        </div>
    </div>
    <!-- end:: Subheader -->
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @include('errormessage')
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        {{$title}}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">                
                        <div class="dropdown dropdown-inline">
                            <a href="{{url('admin/vendor/create')}}" class="btn btn-brand btn-icon-sm" aria-expanded="false">
                                <i class="flaticon2-plus"></i> Add Vendor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <!-- <div class="kt-datatable" id="local_data">
                </div> -->
                <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="vendor_datatable">
                    <thead>
                        <tr>
                            <!--  <th> ID</th> -->
                            <th>Vendor Company Name</th>
                            <th>Email</th>
                            <th>Vendor Contact Number</th>
                            <th>Contact Person Name</th>
                            <th>GST No.</th>
                            <th>PAN No.</th>
                            <th>created_at</th>
                            <!-- <th>Active</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
            </div>
        </div>
    </div>
    <!-- end:: Content -->
</div>


@endsection
@section('script')
<script src="{{url('assets/admin/js/pages/vendor.js')}}" type="text/javascript"></script>
@endsection