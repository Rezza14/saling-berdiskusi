<x-base title="Reset Password">
    <x-auth title="Reset Password">
        <div class="container">
            <div class="card overflow-hidden">
                <div class="bg-login text-center">
                    <div class="bg-login-overlay"></div>
                    <div class="position-relative">
                        <h5 class="text-white font-size-20">Reset Password</h5>
                        <p class="text-white-50 mb-0">
                            Make sure you take note of the password,<br> so that you don't lose it back.
                        </p>
                        <a href="{{ route('login') }}" class="logo logo-admin mt-4">
                            <img src="{{ asset('assets/images/logoS.png') }}" alt="" height="50">
                        </a>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="p-2">
                        <form class="form-horizontal" action="{{ route('password.reset', $token) }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}" readonly>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email" value="{{ old('email', $email) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="userpassword"
                                    name="password_confirmation"
                                    placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                            </div>


                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="customControlInline"
                                    name="remember">
                                <label class="form-check-label" for="customControlInline">Remember me</label>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset
                                    Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-auth>
</x-base>
