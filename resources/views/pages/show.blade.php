<x-base :title="$page->title">
    <div class="row">
        <div class="col-lg-12" style="position: center">
            <div class="card">
                <div class="card-body">
                    <section class="about-section">
                        <div class="auto-container">
                            <h3>{{ $page->title }}</h3>
                            @if (Auth::user() != null &&
                                    Auth::user()->getRoleNames()->implode('') == 'Administrator')
                                <form action="{{ route('page.destroy', $page->slug) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn-sm btn-danger float-end waves-effect waves-light border-0 mx-1 btn-delete"
                                        onclick="return confirm('Are you sure?')"><i
                                            class="bx bx-trash font-size-16 align-middle mr-1"></i>
                                    </button>
                                </form>
                                <x-card-button url="{{ route('page.edit', $page->slug) }}" button-type="button"
                                    button-class="btn-sm btn-warning float-end waves-effect waves-light border-0 mx-1"
                                    icon-class="bx bx-edit-alt font-size-16 align-middle mr-1" />
                            @endif
                            <div class="row clearfix">
                                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                                    <div class="inner-column">
                                        <div class="text">
                                            {!! $page->trixRender('content') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-base>
