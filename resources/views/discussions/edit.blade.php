<x-base title="Data Discussion">
    @trixassets
    <form action="{{ route('discussions.update', $discussion->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title col-12 col-md-6">Edit Discussion Data</h4>
                            <p>Please fill in the following form to edit <code>discussion data.</code></p>
                        </div>
                        @include($view . '_form')
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-base>
