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
                    <a href="{{ route('group.index') }}" class="kt-subheader__breadcrumbs-link">
                        {{ $title }} </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="javascript:void(0);" class="kt-subheader__breadcrumbs-link">
                        {{ ucfirst($action . ' ' . $title) }} </a>
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
                                        <a href="{{ route('group.index') }}" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Back
                                        </a>
                                        &nbsp;
                                    </div>
                                </div>
                            </div>
                            @if ($action == 'create')
                                {!! Form::open([
                                    'route' => 'group.store',
                                    'method' => 'POST',
                                    'class' => 'form-horizontal kt-form kt-form--label-right',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                            @elseif($action == 'edit')
                                {!! Form::model($data, [
                                    'url' => route('group.update', ['group' => $data->id]),
                                    'method' => 'PUT',
                                    'class' => 'form-horizontal kt-form kt-form--label-right',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                            @endif
                            @csrf
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            {{-- {!! Form::label('group_name', 'Group Name', ['class' => 'col-xl-3 col-lg-3 col-form-label required']) !!}       --}}
                                            {!! Form::label('group_name', 'Enter group name', ['class' => 'col-xl-3 col-lg-3 col-form-label required-label font-weight-bold']) !!}

                                            <div class="col-lg-9 col-xl-4">
                                                {!! Form::text('name', null, [
                                                    'id' => 'group_name',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Group Name',
                                                ]) !!}
                                                @error('name')
                                                <span class="alert invalid-feedback text-left" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
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
                                            {!! Form::submit($btn, ['class' => 'btn btn-success']) !!}
                                            {!! link_to_route('group.index', 'Cancel', [], ['id' => 'cancel_btn', 'class' => 'btn btn-secondary']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
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
<style>
.required-label::after {
    content: ' *';
    color: red;
}
</style>
@endsection
