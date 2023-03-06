<x-base :title="$user->name">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="font-size-15 fw-bold" style="margin-bottom: 20px">
                        <span class="fw-bold">Detail User</span>
                    </h3>
                    <div class="profile-widgets py-3">
                        <div class="text-center">
                            <div class="">
                                <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://avatars.dicebear.com/api/initials/' . $user->name . '.png?background=blue' }}"
                                    alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle"
                                    style="width: 150px; height: 150px; border-radius: 50%;">
                            </div>
                            <div class="mt-3 ">
                                <a href="#" class="text-dark fw-medium font-size-16">{{ $user->name }}</a>
                                <p class="text-body mt-1 mb-1">
                                    @if ($user->Admin())
                                        <span class="badge badge-soft-danger fs-6">Administrator</span>
                                    @elseif ($user->Teacher())
                                        <span class="badge badge-soft-success fs-6">Teacher</span>
                                    @elseif($user->Student())
                                        <span class="badge badge-soft-primary fs-6">Student</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @include($view . '_form')
                </div>
            </div>
        </div>
    </div>
</x-base>
