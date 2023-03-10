<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-end">
                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                @if (Auth::user() == !null)
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('profile.index') }}"><i
                                    class="bx bx-user font-size-16 align-middle me-1"></i>
                                Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                Logout
                                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </div>
                @else
                <div class="dropdown d-none d-lg-inline-block">
                    <a href="{{ route('login') }}" class="clearfix" style="color: white">
                        Login
                        <i class="bx bx-log-in font-size-16 align-middle"></i>
                    </a>
                </div>
                @endif
            </div>
            <div>
                <div class="navbar-brand-box">
                    <a href="{{ route('index') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/Asset2.png') }}" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/Asset2.png') }}" alt="" height="50">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>
