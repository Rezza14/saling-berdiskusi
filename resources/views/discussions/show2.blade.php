    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $discussion->title }}</div>
                    <div class="card-body">
                        {{ $discussion->body }}
                        <hr>
                        <small>posted by {{ $discussion->user->name }} at
                            {{ $discussion->created_at->diffForHumans() }}</small>
                    </div>
                </div>

                <br>

                <div class="card">
                    <div class="card-header">Comments</div>

                    <div class="card-body">
                        @foreach ($comments as $comment)
                            <div class="mb-2">
                                <strong>{{ $comment->user->name }}</strong>
                                <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                <p>{{ $comment->body }}</p>
                            </div>
                        @endforeach

                        {{ $comments->links() }}

                        @auth
                            <form action="{{ route('discussions.add-comment', $discussion->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="body">Add Comment</label>
                                    <textarea name="body" id="body" rows="5"
                                        class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}"></textarea>
                                    @if ($errors->has('body'))
                                        <span class="invalid-feedback">{{ $errors->first('body') }}</span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Actions</div>

                <div class="card-body">
                    @auth
                        @if (auth()->user()->id === $discussion->user_id)
                            <div>
                                <form action="{{ route('discussions.destroy', $discussion->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>

                            <div class="mt-2">
                                <a href="{{ route('discussions.edit', $discussion->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
