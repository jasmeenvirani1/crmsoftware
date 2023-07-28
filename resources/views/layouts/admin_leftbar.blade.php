<!-- Left Pannel Starts-->
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ url('admin/dashboard') }}">
                <!-- <img alt="Logo" style="height: 50px; width: 150px" src="{{ url('assets/admin/media/logos/laxmipharma.png') }}" />                                 -->
            </a>
        </div>
        <div class="kt-aside__brand-tools">
        </div>
    </div>
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
            data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item{{ Route::is('dashboard') ? '--active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ url('admin/dashboard') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-layer text-success"></i>
                        </span>
                        <span class="kt-menu__link-text">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->permission[0] == 1)
                    <!-- <li class="kt-menu__item  kt-menu__item{{ Route::is('organization.index') || Route::is('organization.create') || Route::is('organization.edit') ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('organization.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon-map text-success"></i>
                        </span>
                        <span class="kt-menu__link-text">Organization</span>
                    </a>
                </li> -->
                @else
                @endif
                @if (Auth::user()->permission[1] == 1)
                    <!-- <li class="kt-menu__item  kt-menu__item{{ Route::is('role.index') || Route::is('role.create') || Route::is('role.edit') ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('role.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon2-user text-success"></i>
                        </span>
                        <span class="kt-menu__link-text">Users(Role)</span>
                    </a>
                </li> -->
                @else
                @endif
                <li class="kt-menu__item  kt-menu__item{{ Route::is('category.index') || Route::is('category.create') || Route::is('category.edit') ? '--active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('category.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg> -->
                            <i class="flaticon-layer text-success"></i>
                        </span>
                        <span class="kt-menu__link-text"> Category</span>
                    </a>
                </li>
                @if (Auth::user()->permission[2] == 1)
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('quotation.index') || Route::is('quotation.create') || Route::is('quotation.edit') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('quotation.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon-layer text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Vendor</span>
                        </a>
                    </li>
                @else
                @endif
                @if (Auth::user()->permission[3] == 1)
                    <!-- <li class="kt-menu__item  kt-menu__item--submenu {{ Route::is('stock.*') || Route::is('vendor.*') ? 'kt-menu__item--open' : '' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                <a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <i class="fas fa-warehouse text-success"></i>
                        </span>
                        <span class="kt-menu__link-text">Inventory Management</span>
                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>tory/Stock Management</span></span></li> -->
                    <ul class="kt-menu__nav ">
                        <li class="kt-menu__item  kt-menu__item{{ Route::is('stock.index') || Route::is('stock.create') || Route::is('stock.edit') ? '--active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('stock.index') }}" class="kt-menu__link ">
                                <span class="kt-menu__link-icon">
                                    <i class="flaticon-layer text-success"></i>
                                </span>
                                <span class="kt-menu__link-text">Product</span>
                            </a>
                        </li>
                    </ul>
                    <!-- <li class="kt-menu__item {{ Route::is('stock.index') || Route::is('stock.create') || Route::is('stock.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('stock.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Product</span></a></li> -->
                    <!-- <li class="kt-menu__item {{ Route::is('vendor.index') || Route::is('vendor.create') || Route::is('vendor.edit') ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a href="{{ route('vendor.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Vendor</span></a></li> -->
                    <!-- </ul> -->
                    <!-- </div> -->
                    <!-- </li> -->
                @else
                @endif
                <!-- <li class="kt-menu__item  kt-menu__item{{ Route::is('quotation.index') || Route::is('quotation.create') || Route::is('quotation.edit') ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('quotation.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">Purchase</span>
                    </a>
                </li> -->
                @if (Auth::user()->permission[4] == 1)
                    <!-- <li class="kt-menu__item  kt-menu__item{{ Route::is('purchase.index') || Route::is('purchase.create') || Route::is('purchase.edit') ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('purchase.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="fas fa-cart-plus text-success"></i>
                        </span>
                        <span class="kt-menu__link-text">Purchase</span>
                    </a>
                </li> -->
                @else
                @endif
                @if (Auth::user()->permission[5] == 1)
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('customer.index') || Route::is('customer.create') || Route::is('customer.edit') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('customer.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon-layer text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Company</span>
                        </a>
                    </li>
                @else
                @endif
                @if (Auth::user()->permission[6] == 1)
                    <!-- <li class="kt-menu__item  kt-menu__item{{ Route::is('technicalspecification.index') || Route::is('technicalspecification.create') || Route::is('technicalspecification.edit') ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('technicalspecification.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="fas fa-tools text-success"></i>
                        </span>
                        <span class="kt-menu__link-text">TechnicalSpecification</span>
                    </a>
                </li> -->
                @else
                @endif
                @if (Auth::user()->permission[7] == 1)
                    <!-- <li class="kt-menu__item  kt-menu__item{{ Route::is('terms.index') || Route::is('terms.create') || Route::is('terms.edit') ? '--active' : '' }}" aria-haspopup="true"> -->
                    <!-- <a href="{{ route('terms.index') }}" class="kt-menu__link "> -->
                    <!-- <span class="kt-menu__link-icon"> -->
                    <!-- <i class="flaticon2-list text-success"></i> -->
                    <!-- </span> -->
                    <!-- <span class="kt-menu__link-text">Terms</span> -->
                    <!-- </a> -->
                    <!-- </li> -->
                @else
                @endif
                @if (Auth::user()->permission[8] == 1)
                    <!-- <li class="kt-menu__item  kt-menu__item{{ Route::is('notification.index') || Route::is('notification.create') || Route::is('notification.edit') ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('notification.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <i class="flaticon2-notification text-success"></i>
                        </span>
                        <span class="kt-menu__link-text">Notification</span>
                    </a>
                </li> -->
                @else
                @endif
                @if (Auth::user()->permission[9] == 1)
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('gst.index') || Route::is('gst.create') || Route::is('gst.edit') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('gst.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                <i class="flaticon2-settings text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Setting</span>
                        </a>
                    </li>
                @else
                @endif
                <!-- <li class="kt-menu__item  kt-menu__item{{ Route::is('states.index') || Route::is('states.create') || Route::is('states.edit') ? '--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('states.index') }}" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg>
                        </span>
                        <span class="kt-menu__link-text">State</span>
                    </a>
                </li> -->

                @if (Auth::user()->permission[2] == 1)
                    <li class="kt-menu__item  kt-menu__item{{ Route::is('catalog.index') || Route::is('catalog.create') || Route::is('catalog.edit') ? '--active' : '' }}"
                        aria-haspopup="true">
                        <a href="{{ route('catalog.index') }}" class="kt-menu__link ">
                            <span class="kt-menu__link-icon">
                                {{-- <i class="ki-outline ki-calendar-8 fs-2"></i> --}}
                                <i class="flaticon-layer text-success"></i>
                            </span>
                            <span class="kt-menu__link-text">Catalog</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- Left Pannel Starts-->
