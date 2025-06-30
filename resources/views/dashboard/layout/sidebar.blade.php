<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="index.html" class="app-brand-link">
                    <span class="app-brand-logo demo w-100 d-flex align-items-center">
                        
                            <!-- Uncomment the line below if you also wish to use an image logo -->
                           <img src="{{ asset('assets/img/logo.png') }}" alt="" style="width: 40px;height: 40px;">
                            {{-- <h2 class="sitename">Medilab</h2> --}}
                         
                  
                            <span class="app-brand-text demo menu-text fw-bolder ms-2">Medilab</span>
                    </span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                {{-- ! Dashboard --}}
                <li class="menu-item {{ Route::is('show.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('show.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>
                {{-- Info: Admin --}}
                @can('admin-view')
                    {{-- ! Children --}}
                    <li class="menu-item {{ Route::is('child.*', 'vaccination.index') ? 'open active' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-child"></i>
                            <div data-i18n="Childrens">Childrens</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ Route::is('child.index') ? 'active' : '' }}">
                                <a href="{{ route('child.index') }}" class="menu-link">
                                    <div data-i18n="All Child Details">All Child Details</div>
                                </a>
                            </li>
                            <li class="menu-item {{ Route::is('vaccination.index') ? 'active' : '' }}">
                                <a href="{{ route('vaccination.index') }}" class="menu-link">
                                    <div data-i18n="Vaccination Reports">Vaccination Reports</div>
                                </a>
                            </li>
                            <li class="menu-item {{ Route::is('child.pending.requests') ? 'active' : '' }}">
                                <a href="{{ route('child.pending.requests') }}" class="menu-link">
                                    <div data-i18n="Pending Requests">Pending Requests</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- ! Vaccines --}}
                    <li class="menu-item {{ Route::is('vaccine.index') ? 'active' : '' }}">
                        <a href="{{ route('vaccine.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-injection"></i>
                            <div data-i18n="Basic">Vaccines</div>
                        </a>
                    </li>
                    {{-- ! bookings --}}
                    <li class="menu-item {{ Route::is('bookings.index') ? 'active' : '' }}">
                        <a href="{{ route('bookings.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                            <div data-i18n="Bookings">Bookings</div>
                        </a>
                    </li>
                    {{-- ! Hospital --}}
                    <li class="menu-item {{ Route::is('hospital.*') ? 'open active' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-clinic"></i>
                            <div data-i18n="Hospitals">Hospitals</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ Route::is('hospital.create') ? 'active' : '' }}">
                                <a href="{{ route('hospital.create') }}" class="menu-link">
                                    <div data-i18n="Add Hospital">Add Hospital</div>
                                </a>
                            </li>
                            <li class="menu-item {{ Route::is('hospital.index') ? 'active' : '' }}">
                                <a href="{{ route('hospital.index') }}" class="menu-link">
                                    <div data-i18n="List of Hospitals">List of Hospitals</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- ! approvals --}}
                    <li class="menu-item {{ Route::is('user.approval.index') ? 'active' : '' }}">
                        <a href="{{ route('user.approval.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div data-i18n="User Approvals">User Approvals</div>
                        </a>
                    </li>
                @endcan
                {{-- Info: Admin End --}}

                {{-- Info: Hospital --}}
                @can('hospital-view')
                    {{-- ! appointments --}}
                    <li class="menu-item {{ Route::is('hospital.appointments') ? 'active' : '' }}">
                        <a href="{{ route('hospital.appointments') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                            <div data-i18n="update">View Appointments</div>
                        </a>
                    </li>
                    {{-- ! history --}}
                    <li class="menu-item {{ Route::is('hospital.appointments.history') ? 'active' : '' }}">
                        <a href="{{ route('hospital.appointments.history') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-history"></i>
                            <div data-i18n="update">Appointment History</div>
                        </a>
                    </li>
                @endcan
                {{-- Info: Hospital End --}}

                {{-- Info: Parent --}}
                @can('parent-view')
                    {{-- ! Children --}}
                    <li class="menu-item {{ Route::is('parent.child.*') ? 'open active' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-child"></i>
                            <div data-i18n="Childrens">My Children</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ Route::is('parent.child.index') ? 'active' : '' }}">
                                <a href="{{ route('parent.child.index') }}" class="menu-link">
                                    <div data-i18n="All Child Details">All Childs</div>
                                </a>
                            </li>
                            <li class="menu-item {{ Route::is('parent.child.create') ? 'active' : '' }}">
                                <a href="{{ route('parent.child.create') }}" class="menu-link">
                                    <div data-i18n="Add Child">Add Child</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- ! vaccination schedules --}}
                    <li class="menu-item {{ Route::is('parent.schedule.index') ? 'active' : '' }}">
                        <a href="{{ route('parent.schedule.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div data-i18n="my-child">Vaccination Schedule</div>
                        </a>
                    </li>
                    </li>
                    {{-- ! vaccination schedules --}}
                    <li class="menu-item {{ Route::is('parent.requests') ? 'active' : '' }}">
                        <a href="{{ route('parent.requests') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-list-check"></i>
                            <div data-i18n="my-child">My Requests</div>
                        </a>
                    </li>
                    {{-- ! make appointment --}}
                    <li class="menu-item {{ Route::is('parent.appointments') ? 'active' : '' }}">
                        <a href="{{ route('parent.appointments') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-plus-medical"></i>
                            <div data-i18n="my-child">Book Appointment</div>
                        </a>
                    </li>
                    {{-- ! history --}}
                    <li class="menu-item {{ Route::is('parent.history') ? 'active' : '' }}">
                        <a href="{{ route('parent.history') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-history"></i>
                            <div data-i18n="update">Vaccination History</div>
                        </a>
                    </li>
                @endcan
                {{-- Info: Parent end --}}


                {{-- <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Account</span>
                </li> --}}
                {{-- ! Profile --}}
                {{-- <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user-circle"></i>
                        <div data-i18n="Profile">Profile</div>
                    </a>
                </li> --}}
                {{-- ! Settings --}}
                {{-- <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div data-i18n="Settings">Settings</div>
                    </a>
                </li> --}}
                {{-- ! Logout --}}
                <li class="menu-item">
                    <a href="{{ route('auth.logout') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-log-out"></i>
                        <div data-i18n="Logout">Logout</div>
                    </a>
                </li>

            </ul>
        </aside>


        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    {{-- <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                                aria-label="Search..." />
                        </div>
                    </div> --}}
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->
                        {{-- <li class="nav-item lh-1 me-3">
                            <a class="github-button"
                                href="https://github.com/themeselection/sneat-html-admin-template-free"
                                data-icon="octicon-star" data-size="large" data-show-count="true"
                                aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                        </li> --}}

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="{{ asset('dashboard-assets/assets/img/avatars/1.png') }}" alt
                                        class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="../assets/img/avatars/1.png" alt
                                                        class="w-px-40 h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">@auth
                                                        {{ Auth::user()->name }}
                                                    @endauth
                                                </span>
                                                <small class="text-muted">{{ Auth::user()->role }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <span class="d-flex align-items-center align-middle">
                                            <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                            <span class="flex-grow-1 align-middle">Billing</span>
                                            <span
                                                class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                        </span>
                                    </a>
                                </li> --}}
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
