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
                    <a href="{{ route('dashboard') }}" class="kt-subheader__breadcrumbs-link">
                        Dashboard </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ url('admin/role') }}" class="kt-subheader__breadcrumbs-link">
                        Role </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                        Edit {{ $title }} </a>
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
                                        <a href="{{ route('role.index') }}" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Back
                                        </a>
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            {!! Form::open([
                                'url' => route('role.update', ['role' => $data->id]),
                                'method' => 'PUT',
                                'class' => 'form-horizontal kt-form kt-form--label-right',
                                'enctype' => 'multipart/form-data',
                            ]) !!}

                            <form action="{{ route('role.update', ['role' => $data->id]) }}" method="POST"
                                class="form-horizontal kt-form kt-form--label-right" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                @csrf

                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label"><b>Roll Name</b><span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9 col-xl-4">
                                                    <input type="text" name="name" id="name" class="form-control"
                                                        placeholder="Roll Name" required value="{{ $data->name }}"
                                                        readonly>
                                                </div>
                                            </div>
                                            @php
                                                $roles = config('role.roles');
                                                $exits_oprations = json_decode($data->permissions);
                                            @endphp
                                            @foreach ($roles as $key => $value)
                                                <div class="form-group row">
                                                    <label
                                                        class="col-xl-3 col-lg-3 col-form-label"><b>{{ ucfirst($key) }}</b><span
                                                            class="text-danger"></span></label>
                                                    @foreach ($value as $operation)
                                                        <div class="col-lg-4 col-xl-2">
                                                            <span class="switch switch-info">
                                                                <label>
                                                                    <input type="checkbox" name="{{ $key }}[]"
                                                                        id="{{ $key . $operation }}"
                                                                        value="{{ $operation }}"
                                                                        @if (property_exists($exits_oprations, $key) && in_array($operation, $exits_oprations->$key)) checked @endif />
                                                                    <span></span>
                                                                </label>
                                                                <label
                                                                    for="{{ $key . $operation }}"><b>{{ ucfirst($operation) }}</b></label>
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3">
                                            </div>
                                            <div class="col-lg-9 col-xl-9">
                                                <button type="submit" class="btn btn-success"
                                                    onclick="return Validate()">{{ $btn }}</button>&nbsp;
                                                <a href="{{ route('role.index') }}" id="cancel_btn"
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
@endsection
