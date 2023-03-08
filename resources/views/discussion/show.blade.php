{{-- todo : change title to discussion name --}}
<x-base title="Error Blade Laravel">
    <div class="card">
        <div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-headline">
                                <div class="panel-heading">
                                    <h3 class="panel-title mt-4">Error Blade Laravel</h3>
                                    <p><img class="img-fluid img-profile rounded-circle mx-auto mb-2" style="width: 30px"
                                            src="{{ asset('storage/' . Auth()->user()->image) }}" alt="">
                                        <span class="text-muted">Faris | 2 days ago</span>
                                    </p>
                                    {{-- @if ($data->updated_at != $data->created_at) --}}
                                    <i class="text-muted">* Edited</i>
                                    {{-- @endif --}}
                                </div>
                                <hr>
                                <strong>
                                    <div class="panel-body"> Kalau boleh tau ini error nya kenapa yaa
                                    </div>
                                </strong>
                                <button class="btn btn-warning btn-sm mt-2 mb-2">#Laravel</button>
                                <hr>
                                <form
                                    action="
                                {{-- {{ route($route.'store') }} --}}
                                "
                                    method="POST">
                                    @csrf
                                    <textarea name="komentar" class="form-control" rows="4"></textarea>
                                    <button type="submit" name="submit"
                                        class="btn btn-secondary waves-effect waves-light mb-4 float-end me-1 mb-4 mt-3 btn-delete"><i
                                            class="lnr lnr-bubble"></i>
                                        Send Comment
                                    </button>
                                </form>
                                <h4 class="panel-title mt-3">2 Comments</h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <p><img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                                                style="width: 30px"
                                                src="{{ asset('storage/' . Auth()->user()->image) }}" alt="">
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
                                                style="width: 30px" src="{{ asset('assets/images/profile_4x.png') }}"
                                                alt="">
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
