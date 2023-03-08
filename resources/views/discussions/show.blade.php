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
                                        <form action="{{ route('discussions.destroy', $discussion->slug) }}"
                                            method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn-sm btn-danger float-end waves-effect waves-light border-0 mx-1 btn-delete"
                                                onclick="return confirm('Are you sure?')"><i
                                                    class="bx bx-trash font-size-16 align-middle mr-1"></i>
                                            </button>
                                        </form>
                                        <x-card-button url="{{ route('discussions.edit', $discussion->slug) }}"
                                            button-type="button"
                                            button-class="btn-sm btn-warning float-end waves-effect waves-light border-0 mx-1"
                                            icon-class="bx bx-edit-alt font-size-16 align-middle mr-1" />
                                    @endif
                                    <p><img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                                            style="width: 30px"
                                            src="{{ $discussion->user->image ? asset('storage/' . $discussion->user->image) : 'https://avatars.dicebear.com/api/initials/' . $discussion->user->name . '.png?background=blue' }}"
                                            alt="">
                                        <span class="text-muted">{{ $discussion->user?->name }} |
                                            {{ $discussion->created_at->diffForHumans() }}</span>
                                    </p>
                                    @if ($discussion->updated_at != $discussion->created_at)
                                        <i class="text-muted">* Edited</i>
                                    @endif
                                </div>
                                <hr>
                                <strong>
                                    <div class="panel-body">
                                        <p>{!! $discussion->trixRender('body') !!}</p>
                                    </div>
                                </strong>
                                {{-- till here --}}
                                <button class="btn btn-warning btn-sm mt-2 mb-2">{{ $discussion->tags }}</button>
                                <hr>
                                <form
                                    action="
                                {{-- {{ route($route.'store') }} --}}
                                "
                                    method="POST">
                                    @csrf
                                    <textarea name="komentar" class="form-control" rows="4"></textarea>
                                    <button type="submit" name="submit"
                                        class="btn btn-secondary waves-effect waves-light mb-4 float-end me-1 mb-4 mt-3"><i
                                            class="lnr lnr-bubble"></i>
                                        Send Comment
                                    </button>
                                </form>
                                <h4 class="panel-title mt-3">2 Comments</h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <p><img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                                                style="width: 30px" src="" alt="">
                                            <span class="text-muted">Rezza | 2 minutes ago</span>
                                            <span class="d-block">
                                                Hadehh masalah sepele aja masa gatau dek, jadi gini lu harus pake spell
                                                flicker kalo pake hero layla, yaa that's bcz layla doesn't have skill
                                                kabur
                                            </span>
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        <p><img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                                                style="width: 30px" src="" alt="">
                                            <span class="text-muted">Budi | 2 Hours ago</span>
                                            <span class="d-block">
                                                Ehh btw ini kenapa foto profil gw gepeng bangke
                                            </span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base>
