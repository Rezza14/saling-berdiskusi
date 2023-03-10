<x-base title="Discussion Detail">
    <div class="card">
        <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-headline">
                                <div class="panel-heading">
                                    <h3 class="panel-title mt-4">{{ $discussion->title }}</h3>
                                    @if ($user != null && $user->id == $discussion->user_id)
                                        <form action="{{ route('discussions.destroy', $discussion->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn-sm btn-danger float-end waves-effect waves-light border-0 mx-1 btn-delete"
                                                onclick="return confirm('Are you sure?')"><i
                                                    class="bx bx-trash font-size-16 align-middle mr-1"></i>
                                            </button>
                                        </form>
                                        <x-card-button url="{{ route('discussions.edit', $discussion->id) }}"
                                            button-type="button"
                                            button-class="btn-sm btn-warning float-end waves-effect waves-light border-0 mx-1"
                                            icon-class="bx bx-edit-alt font-size-16 align-middle mr-1" />
                                        {{-- todo : fix get role names if user is null --}}
                                    @elseif (Auth::user() != null &&
                                            Auth::user()->getRoleNames()->implode('') == 'administrator')
                                        <form action="{{ route('discussions.destroy', $discussion->id) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn-sm btn-danger float-end waves-effect waves-light border-0 mx-1 btn-delete"
                                                onclick="return confirm('Are you sure?')"><i
                                                    class="bx bx-trash font-size-16 align-middle mr-1"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <p><img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                                            style="width: 30px"
                                            src="{{ $discussion->user->image ? asset('storage/' . $discussion->user->image) : 'https://avatars.dicebear.com/api/initials/' . $discussion->user->name . '.png?background=blue' }}"
                                            alt="">
                                        <span class="text-muted">{{ $discussion->user?->name ?? 'User Not found' }} |
                                            @if ($discussion->user?->Admin())
                                                <span class="badge badge-soft-danger fs-6">Administrator</span>
                                            @elseif ($discussion->user?->Teacher())
                                                <span class="badge badge-soft-success fs-6">Teacher</span>
                                            @elseif($discussion->user?->Student())
                                                <span class="badge badge-soft-primary fs-6">Student</span>
                                            @endif |
                                            {{ $discussion->created_at->diffForHumans() }}
                                            @if ($discussion->updated_at != $discussion->created_at)
                                                <i class="text-muted">* Edited</i>
                                            @endif
                                        </span>
                                    </p>
                                </div>
                                <hr>
                                <strong>
                                    <div class="panel-body">
                                        <p>{!! $discussion->trixRender('body') !!}</p>
                                    </div>
                                </strong>
                                <button class="btn btn-warning btn-sm mt-2 mb-2">{{ $discussion->tags }}</button>
                                <hr>
                                <form action="{{ route('comments.store', $discussion->id) }}" method="POST">
                                    @csrf
                                    <textarea name="comment" class="form-control" rows="4"></textarea>
                                    <button type="submit" name="submit"
                                        class="btn btn-secondary waves-effect waves-light mb-4 float-end me-1 mb-4 mt-3"><i
                                            class="lnr lnr-bubble"></i>
                                        Send Comment
                                    </button>
                                </form>
                                <br><br><br>
                                <h4 class="panel-title mt-3">{{ $commentsCount }} Comments</h4>
                                <div class="widget-content" style="max-height: 500px; overflow-y: auto">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($comments as $comment)
                                            <li class="list-group-item">
                                                <p><img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                                                        style="width: 30px"
                                                        src="{{ $comment->user?->image ? asset('storage/' . $comment->user?->image) : 'https://avatars.dicebear.com/api/initials/' . $comment->user?->name . '.png?background=blue' }}"
                                                        alt="">
                                                    <span class="text-muted">{{ $comment->user?->name ?? 'User Not found' }} |
                                                        @if ($comment->user?->Admin())
                                                            <span
                                                                class="badge badge-soft-danger fs-6">Administrator</span>
                                                        @elseif ($comment->user?->Teacher())
                                                            <span class="badge badge-soft-success fs-6">Teacher</span>
                                                        @elseif($comment->user?->Student())
                                                            <span class="badge badge-soft-primary fs-6">Student</span>
                                                        @endif |
                                                        {{ $comment->created_at->diffForHumans() }}
                                                        @if ($comment->updated_at != $comment->created_at)
                                                            <i class="text-muted">* Edited</i>
                                                        @endif
                                                    </span>
                                                    <span class="d-block">
                                                        {{ $comment->comment }}
                                                    </span>
                                                    @if ($user != null && $user->id == $comment->user_id)
                                                        <form action="{{ route('comments.destroy', $comment->id) }}"
                                                            method="post" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn-sm btn-danger waves-effect waves-light border-0 btn-delete"
                                                                onclick="return confirm('Delete comment permanently?')"><i
                                                                    class="bx bx-trash font-size-12 align-middle mr-1"></i>
                                                            </button>
                                                        </form>
                                                        <x-card-button url="{{ route('comments.edit', $comment) }}"
                                                            button-type="button"
                                                            button-class="btn-sm btn-warning waves-effect waves-light border-0"
                                                            icon-class="bx bx-edit-alt font-size-12 align-middle mr-1" />
                                                    @elseif (Auth::user() != null &&
                                                            Auth::user()->getRoleNames()->implode('') == 'administrator')
                                                        <form action="{{ route('comments.destroy', $comment->id) }}"
                                                            method="post" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn-sm btn-danger waves-effect waves-light border-0 btn-delete"
                                                                onclick="return confirm('Delete comment permanently?')"><i
                                                                    class="bx bx-trash font-size-12 align-middle mr-1"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
