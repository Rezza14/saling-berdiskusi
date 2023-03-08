<x-base title="Data Discussion">
    @trixassets
    <form action="{{ route('discussions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title col-12 col-md-6">Add Discussion Data</h4>
                            <p>Please fill in the following form to add <code>discussion data.</code></p>
                        </div>
                        @include($view . '_form')
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-base>
