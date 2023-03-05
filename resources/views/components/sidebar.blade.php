<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}"
                    alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a class="text-dark fw-medium font-size-16">{{ Auth::User()->name }}</a>
                <p class="text-body mt-1 mb-0 font-size-13">{{ Auth::user()->getRoleNames()->implode('') }}</p>

            </div>
        </div>

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('index') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>




        </div>
    </div>
</div>
