<x-input identifier="title" label-text="Title" type="text" placeholder="Enter Title" :value="old('title', $page ?? null)" required
    :disabled="request()->routeIs($route . 'show')" />
@if (request()->routeIs($route . 'show'))
    <x-input label-text="Slug" value="{{ $page->slug }}" required disabled />
@endif
<x-trix-editor identifier="content" label-text="Content" :data="$page ?? null" field="content" :disabled="request()->routeIs($route . 'show')"
    :model="\App\Models\Page::class" required />
@if (!request()->routeIs($route . 'show'))
    <x-card-button button-type="submit" text="Submit" icon-class="bx bxs-save font-size-16 align-middle me-2"
        button-class="btn btn-primary waves-effect waves-light mb-4 float-end mt-3 btnSubmitMessage" />
@else
    <x-card-button url="{{ route($route . 'edit', $page) }}" button-type="button" text="Edit"
        icon-class="bx bx-edit-alt font-size-16 align-middle me-2"
        button-class="btn btn-primary waves-effect waves-light mb-4 float-end mt-3" />
@endif
