<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">                           
    </div>
    <div class="kt-header__topbar">
        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ucfirst(Auth::user()->name)}}</span>
                    <img class="kt-hidden" alt="Pic" src="{{url('assets/admin/media/users/300_25.jpg')}}" />                    
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ucfirst(substr(Auth::user()->name,0,1))}}</span>
                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{url('assets/admin/media/misc/bg-1.jpg')}})">
                    <div class="kt-user-card__avatar">
                        <img class="kt-hidden" alt="Pic" src="{{url('assets/admin/media/users/300_25.jpg')}}" />
                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ucfirst(substr(Auth::user()->name,0,1))}}</span>
                    </div>
                    <div class="kt-user-card__name">
                        {{ucfirst(Auth::user()->name)}}
                    </div>
<!--                    <div class="kt-user-card__badge">
                        <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                    </div> -->
                </div>

                <div class="kt-notification">
                    <a href="{{url('/admin/my-profile')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                My Profile
                            </div>
                            <div class="kt-notification__item-time">
                                Account Information
                            </div>
                        </div>
                    </a>
                    <a href="{{url('/admin/change-password')}}" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-mail kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold">
                                Password
                            </div>
                            <div class="kt-notification__item-time">
                                Update your password
                            </div>
                        </div>
                    </a>
                    <div class="kt-notification__custom kt-space-between">
                        <a href="{{url('/logout')}}" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                    </div>
                </div>

                <!--end: Navigation -->
            </div>
        </div>

        <!--end: User Bar -->
    </div>                        
</div>