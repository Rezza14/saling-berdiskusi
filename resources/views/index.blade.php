<x-base title="Discussion Forum">
    <div class="row">
        <div class="col-lg-12" style="position: center">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 col-12 col-md-6">All Question</h4>
                    <x-card-button url="" button-type="button"
                        button-class="btn btn-primary waves-effect waves-light mb-4"
                        icon-class="bx bx-add-to-queue font-size-16 align-middle me-2" text="Add Discussion Forum" />
                    <x-filter class="mx-1" :fields="[['name' => 'title', 'label' => 'Title', 'type' => 'text']]" reset-url="" />
                    <section id="gallery">
                        <div class="container">
                            <div class="row" style="display :flex">
                                <div class="col-lg-4 mb-4">
                                    <div class="card" style="box-shadow: 0 5px 3px rgba(0, 0, 0, 0.3)">

                                        <div class="card-body">
                                            <a href=""></a>
                                            <h2 class="card-title"><a href="{{ url('/discussion-show') }}"> Error Blade
                                                    Laravel</a></h2>
                                            <p class="card-text">Kalau boleh tau ini error nya kenapa yaa</p>
                                            <button class="btn btn-warning btn-sm">#Laravel</button>
                                        </div>
                                        <div class="card-footer text-muted" style="18rem;">
                                            Faris | 2 days ago
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
