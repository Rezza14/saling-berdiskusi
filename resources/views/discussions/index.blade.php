    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Discussions</div>
                    <div class="card-body">
                        <ul>
                            @foreach ($discussions as $discussion)
                                <li>
                                    <a href="{{ route('discussions.show', $discussion->id) }}">{{ $discussion->title }}</a>
                                    <br>
                                    <small>posted by {{ $discussion->users?->name }} at
                                        {{ $discussion->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        </ul>

                        {{ $discussions->links() }}

                        <a href="{{ route('discussions.create') }}" class="btn btn-primary">Create Discussion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
