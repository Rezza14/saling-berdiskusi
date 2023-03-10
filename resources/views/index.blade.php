<x-base title="Discussion Forum">
    <div class="row">
        <div class="col-lg-12" style="position: center">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 col-12 col-md-6">All Discussions</h4>
                    @if (Auth::user() != null)
                        <x-card-button url="{{ route('discussions.create') }}" button-type="button"
                            button-class="btn btn-primary waves-effect waves-light mb-4"
                            icon-class="bx bx-add-to-queue font-size-16 align-middle me-2" text="Add Discussion Forum" />
                    @endif
                    <x-filter class="mx-1" :fields="[['name' => 'title', 'label' => 'Title', 'type' => 'text']]" reset-url="{{ route('index') }}" />
                    <section id="gallery">
                        <div class="container">
                            <div class="row" style="display :flex">
                                @forelse ($discussion as $discussions)
                                    <div class="col-lg-4 mb-4">
                                        <div class="card" style="box-shadow: 0 5px 3px rgba(0, 0, 0, 0.3)">

                                            <div class="card-body">
                                                <a href="{{ route('discussions.show', $discussions->id) }}"></a>
                                                <h2 class="card-title"><a
                                                        href="{{ route('discussions.show', $discussions->id) }}">
                                                        {{ $discussions->title }}</a></h2>
                                                <p class="card-text"> {!! str(strip_tags($discussions->trixRender('content')))->limit(20) !!}</p>
                                                <button class="btn btn-warning btn-sm">{{ $discussions->tags }}</button>
                                            </div>
                                            <div class="card-footer text-muted" style="18rem;">
                                                {{ $discussions->user?->name }} |
                                                {{ $discussions->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-danger">
                                            <h5>No data</h5>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                    {{ $discussion->links() }}
                </div>
            </div>
        </div>
    </div>
</x-base>
