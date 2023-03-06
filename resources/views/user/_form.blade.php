<x-input identifier="name" label-text="Name" type="text" placeholder="Enter Name" :value="old('name', $user ?? null)" required
    :disabled="request()->routeIs($route . 'show')" />
<x-input identifier="email" label-text="Email" type="email" placeholder="Enter Email" :value="old('email', $user ?? null)" required
    :disabled="request()->routeIs($route . 'show')" />
<x-input identifier="username" label-text="Username" type="text" placeholder="Enter Username" :value="old('username', $user ?? null)" required
    :disabled="request()->routeIs($route . 'show')" />
@if (request()->routeIs($route . 'edit'))
    <div class="mb-2 row">
        <label for="" class="col-md-2 col-form-label">
        </label>
        <div class="col-md-5">
            <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}"
                alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle"
                style="width: 150px; height: 150px; border-radius: 50%;">
        </div>
    </div>
@endif
@if (!request()->routeIs($route . 'show'))
    <x-input identifier="image" label-text="Image" type="file" :value="old('image', $user ?? null)" :required="request()->routeIs($route . 'create')" />
@endif
@if (!request()->routeIs($route . 'show'))
    <x-select :list="\App\Enums\RoleEnum::array()" :selectedId="!empty($user)
        ? $user
            ->roles()
            ->pluck('name', 'id')
            ->toArray()
        : []" title="Role User" name="role" id="role" required />
    <x-input identifier="password" label-text="User Password" type="password" placeholder="********"
        :required="request()->routeIs($route . 'create')" />
    <x-input identifier="password_confirmation" label-text="Confirmation user password" type="password"
        placeholder="********" :required="request()->routeIs($route . 'create')" />
    <x-card-button button-type="submit" text="Submit" icon-class="bx bxs-save font-size-16 align-middle me-2"
        button-class="btn btn-primary waves-effect waves-light mb-4 float-end mt-3 btnSubmitMessage" />
@else
    <x-card-button url="{{ route($route . 'edit', $user) }}" button-type="button" text="Edit"
        icon-class="bx bx-edit-alt font-size-16 align-middle me-2"
        button-class="btn btn-primary waves-effect waves-light mb-4 float-end mt-3" />
@endif
