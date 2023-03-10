<x-base title="Data Comment">
    <form action="{{ route('comments.update', $comment) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-title col-12 col-md-6">Edit Comment Data</h4>
                            <p>Please fill in the following form to edit <code>comment data.</code></p>
                        </div>
                        <x-textarea identifier="comment" label-text="comment" :value="old('comment', $comment ?? null)" required
                            :disabled="request()->routeIs($route . 'show')">
                        </x-textarea>
                        <x-card-button button-type="submit" text="Submit"
                            icon-class="bx bxs-save font-size-16 align-middle me-2"
                            button-class="btn btn-primary waves-effect waves-light mb-4 float-end mt-3 btnSubmitMessage" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-base>
