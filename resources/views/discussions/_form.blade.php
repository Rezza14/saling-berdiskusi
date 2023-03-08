<x-input identifier="title" label-text="Title" type="text" placeholder="Enter Title" :value="old('title', $discussion ?? null)" required/>
<x-trix-editor identifier="body" label-text="Body" :data="$discussion ?? null" field="body" :disabled="request()->routeIs($route . 'show')" :model="\App\Models\Discussion::class"
    required />
    <x-input identifier="tags" label-text="Tags" type="text" placeholder="Enter Tags" :value="old('tags', $discussion ?? null)" hint="Example : #laravel"/>
<x-card-button button-type="submit" text="Submit" icon-class="bx bxs-save font-size-16 align-middle me-2"
    button-class="btn btn-primary waves-effect waves-light mb-4 float-end mt-3 btnSubmitMessage" />
