<x-base title="Data User">
    <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title col-12 col-md-6">Edit User Data</h4>
                            <p>Please fill in the following form to edit <code>user data.</code></p>
                        </div>
                        @include($view . '_form')
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-base>
