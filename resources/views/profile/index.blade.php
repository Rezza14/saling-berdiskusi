<x-base title="Profile Data">

    @push('css')
        <link rel="stylesheet" href="{{ asset('libs/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('libs/select2-bootstrap-5-theme/select2-bootstrap-5-theme.css') }}" />
    @endpush

    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profile Data Detail</h4>
                    <p class="card-title-desc">Make sure <code> Profile Data</code> bellow according to your personal
                        information.
                    </p>
                    <form action="{{ route('profile.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-input value="{{ old('name', $user->name ?? null) }}" label-text="Name" identifier="name"
                            type="text" required />
                        <x-input value="{{ old('email', $user->email ?? null) }}" label-text="Email" identifier="email"
                            type="email" required />
                        <x-input value="{{ old('username', $user->username ?? null) }}" label-text="Username"
                            identifier="username" type="text" required />
                        <x-card-button button-type="submit" text="Submit"
                            icon-class="bx bxs-save font-size-16 align-middle me-2"
                            button-class="btn btn-primary waves-effect waves-light mt-3 mb-4 float-end"
                            url="javascript:void(0)" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Profile Photo</h4>
                    <p class="card-title-desc">Make sure <code> Profile Photo</code> bellow according to your photo.</p>
                    <div class="text-center">
                        <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}"
                            alt="user" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px;">
                    </div>
                    <div class="text-center mt-3">
                        <button type="button"
                            class="btn-sm btn-primary waves-effect waves-light p-2 border-0 mx-1 my-3 btn-restore"
                            data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"> Update Photo
                        </button>
                    </div>
                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0">Upload Photo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('profile.updateAvatar') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <x-input identifier="image" label-text="Image" type="file" />
                                        <div class="d-flex justify-content-end">
                                            <x-card-button
                                                button-class="btn-sm btn-primary waves-effect waves-light border-0 mx-1 my-3 float-right"
                                                text="Submit" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Reset Password</h4>
                    <p class="card-title-desc">You can reset your <code>password</code>
                        by filling out the form bellow.</p>
                    <form action="{{ route('profile.updatePassword', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-input placeholder="********" label-text="Old Password" identifier="old_password"
                            type="password" />
                        <x-input placeholder="********" label-text="New Password" identifier="new_password"
                            type="password" />
                        <x-input placeholder="********" label-text="Confirmation new password"
                            identifier="new_password_confirmation" type="password" />
                        <x-card-button button-type="submit" text="Reset Password"
                            icon-class="bx bxs-save font-size-16 align-middle me-2"
                            button-class="btn btn-primary waves-effect waves-light mt-1 mb-1 float-end"
                            url="javascript:void(0)" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-base>
