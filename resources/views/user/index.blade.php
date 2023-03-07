<x-base title="Data User">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 col-12 col-md-6">List User</h4>
                    <x-card-button url="{{ route('user.create') }}" button-type="button"
                        button-class="btn btn-primary waves-effect waves-light mb-4"
                        icon-class="bx bx-add-to-queue font-size-16 align-middle me-2" text="Add User" />
                    <x-filter class="mx-1" :fields="[['name' => 'name', 'label' => 'Name', 'type' => 'text']]" :reset-url="route('user.index')" />
                    <div class="table-responsive text-nowrap">
                        <table class="table mb-3">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $index => $u)
                                    <tr>
                                        <td>{{ $index + $users->firstItem() }}</td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->getRoleNames()->implode(', ') }}</td>

                                        <td>
                                            <x-card-button url="{{ route('user.show', $u->id) }}" button-type="button"
                                                button-class="btn-sm btn-success waves-effect waves-light border-0 mx-1"
                                                icon-class="bx bxs-user-detail font-size-16 align-middle mr-1"
                                                text="Show" />
                                            <x-card-button url="{{ route('user.edit', $u->id) }}" button-type="button"
                                                button-class="btn-sm btn-primary waves-effect waves-light border-0 mx-1"
                                                icon-class="bx bx-edit-alt font-size-16 align-middle mr-1"
                                                text="Edit" />
                                            <form action="{{ route('user.destroy', $u->id) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn-sm btn-danger waves-effect waves-light border-0 mx-1 btn-delete"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="bx bx-trash font-size-16 align-middle mr-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
