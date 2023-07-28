
@if ($message = Session::get('login_error'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="alert-text">{{$message }}</div>
    <div class="alert-close"> <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i> </div>
</div>
@endif


@if ($message = Session::get('fortgot_email_not_found'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="alert-text">{{$message }}</div>
    <div class="alert-close"> <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i> </div>
</div>
@endif

@if ($message = Session::get('invalid_reset_url'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <div class="alert-text">{{$message }}</div>
    <div class="alert-close"> <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i> </div>
</div>
@endif

@if ($message = Session::get('reset_link_sucess'))
<div class="alert alert-success alert-dismissible" role="alert">
    <div class="alert-text">{{$message }}</div>
    <div class="alert-close"> <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i> </div>
</div>
@endif


@if ($message = Session::get('password_updated'))
<div class="alert alert-success alert-dismissible" role="alert">
    <div class="alert-text">{{$message }}</div>
    <div class="alert-close"> <i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i> </div>
</div>
@endif




@if ($message = Session::get('success'))
<div class="alert alert-solid-success alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
    <div class="alert-icon"><i class="fa fa-check-circle"></i></div>    
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif

@if ($message = Session::get('status'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">x</button> 
    {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-solid-danger alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
    <div class="alert-icon"><i class="fas fa-times"></i></div>    
    <div class="alert-text">{{ $message }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif


@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">x</button>	
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">x</button>	
    <strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">

    <button type="button" class="close" data-dismiss="alert">x</button>	
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}<br></li>
        @endforeach
    </ul>  
</div>
@endif