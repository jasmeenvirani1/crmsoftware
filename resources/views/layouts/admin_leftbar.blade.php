<!-- Left Pannel Starts-->
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ url('admin/dashboard') }}"></a>
        </div>
        <div class="kt-aside__brand-tools">
        </div>
    </div>
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
            data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">

                @if (CheckPermissionForUser('dashboard', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('dashboard') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ url('admin/dashboard') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="nav-icon fas fa-tachometer-alt text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Dashboard</span>
                        </a>
                    </li>
                @endif
                @if (CheckPermissionForUser('category', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('category.*') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('category.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="fas fa-th text-success"></i>
                            </span>
                            <span class="kt-menu__link-text"> Category</span>
                        </a>
                    </li>
                @endif
                @if (CheckPermissionForUser('vendor', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('vendors.*') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('vendors.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="fas fa-handshake text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Vendors</span>
                        </a>
                    </li>
                @endif

                @if (CheckPermissionForUser('group', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('group.*') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('group.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="fas fa-users text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Groups</span>
                        </a>
                    </li>
                @endif

                @if (CheckPermissionForUser('product', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('stock.*') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('stock.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="fas fa-cubes text-success "></i>
                            </span>
                            <span class="kt-menu__link-text">Products</span>
                        </a>
                    </li>
                @endif

                @if (CheckPermissionForUser('product', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('company.*') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('company.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="fas fa-building text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Company</span>
                        </a>
                    </li>
                @endif


                @if (CheckPermissionForUser('catalog', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('catalog.*') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('catalog.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                {{-- <i class="ki-outline ki-calendar-8 fs-2"></i> --}}
                                <i class="fas fa-file-alt text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Catalog</span>
                        </a>
                    </li>
                @endif

                @if (CheckPermissionForUser('role', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('role.*') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('role.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="fas fa-lock text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Permissions & Roles</span>
                        </a>
                    </li>
                @endif


                @if (CheckPermissionForUser('setting', 'view'))
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('gst.*') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('gst.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-settings text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Setting</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- Left Pannel Starts-->
