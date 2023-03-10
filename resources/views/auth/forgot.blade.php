<x-base title="Forgot Password">
    <x-auth title="Forgot Password">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
        <div class="container">
            <div class="card overflow-hidden">
                <div class="bg-login text-center">
                    <div class="bg-login-overlay"></div>
                    <div class="position-relative">
                        <h5 class="text-white font-size-20">Forgot Password</h5>
                        <p class="text-white-50 mb-0">Reset Password</p>
                        <a href="{{ route('login') }}" class="logo logo-admin mt-4">
                            <img src="{{ asset('assets/images/logoS.png') }}" alt="" height="50">
                        </a>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <div class="p-2">
                        <form action="{{ route('forgot-password') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="alert alert-success text-center mb-4" role="alert">
                                Enter the email address you used when you signed in and we'll send you a hint to
                                reset your password.
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email"
                                    name="email">
                            </div>

                            <div class="row mb-0">
                                <div class="col-12 text-end">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-auth>
</x-base>
