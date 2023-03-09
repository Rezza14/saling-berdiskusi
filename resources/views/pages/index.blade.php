<x-base title="Data Pages">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 col-12 col-md-6">List Pages</h4>
                    <x-card-button url="{{ route('page.create') }}" button-type="button"
                        button-class="btn btn-primary waves-effect waves-light mb-4"
                        icon-class="bx bx-add-to-queue font-size-16 align-middle me-2" text="Add Pages Data" />
                    <x-filter class="mx-1" :fields="[['name' => 'title', 'label' => 'Title', 'type' => 'text']]" :reset-url="route('page.index')" />
                    <div class="table-responsive text-nowrap">
                        <table class="table mb-3">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($page as $index => $pages)
                                    <tr>
                                        <td>{{ $index + $page->firstItem() }}</td>
                                        <td>{{ $pages->title }}</td>
                                        <td>
                                            <x-card-button url="{{ route('page.show', $pages->slug) }}"
                                                button-type="button"
                                                button-class="btn-sm btn-success waves-effect waves-light border-0 mx-1"
                                                icon-class="bx bxs-user-detail font-size-16 align-middle mr-1"
                                                text="Show" />
                                            <x-card-button url="{{ route('page.edit', $pages->slug) }}"
                                                button-type="button"
                                                button-class="btn-sm btn-primary waves-effect waves-light border-0 mx-1"
                                                icon-class="bx bx-edit-alt font-size-16 align-middle mr-1"
                                                text="Edit" />
                                            <form action="{{ route('page.destroy', $pages->slug) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn-sm btn-danger waves-effect waves-light border-0 mx-1 btn-delete"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bx bx-trash font-size-16 align-middle mr-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $page->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
