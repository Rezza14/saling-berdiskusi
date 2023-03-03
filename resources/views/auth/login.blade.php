<x-auth title="Login">
    <div class="container">
        <div class="card overflow-hidden">
            <div class="bg-login text-center">
                <div class="bg-login-overlay"></div>
                <div class="position-relative">
                    <h5 class="text-white font-size-20">Welcome!</h5>
                    <p class="text-white-50 mb-0">Login to enter the dashboard</p>
                    <a href="{{ route('login') }}" class="logo logo-admin mt-4">
                        <img src="{{ asset('assets/images/LOGO TOK@2.png') }}" alt="" height="50">
                    </a>
                </div>
            </div>
            <div class="card-body pt-5">
                <div class="p-2">
                    <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="username"
                                name="username">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="userpassword">Password</label>
                            <input type="password" class="form-control" id="password"
                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" name="password">
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customControlInline" name="remember">
                            <label class="form-check-label" for="customControlInline">Remember me</label>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log
                                In</button>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{ route('forgot-password') }}" class="text-muted">
                                <i class="mdi mdi-lock me-1"></i> Forgot password?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-auth>
