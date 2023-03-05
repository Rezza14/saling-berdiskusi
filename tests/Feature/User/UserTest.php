<?php

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use function Pest\Faker\faker;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

/**
 * @group user index page
 */
it('can\'t access user page (unauthorize)', function () {
    get(route('user.index'))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access user page (user not admin)', function (User $user) {
    actingAs($user)
        ->get(route('user.index'))
        ->assertForbidden();
})->with('user');

it('can access user index page', function (User $admin) {
    actingAs($admin)
        ->get(route('user.index'))
        ->assertSuccessful()
        ->assertSeeText('index page');
})->with('user_administrator');

/**
 * @group user create page
 */
it('can\'t access user create page (unauthorized)', function () {
    get(route('user.create'))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access user create page (user not admin)', function (User $user) {
    actingAs($user)
        ->get(route('user.create'))
        ->assertForbidden();
})->with('user');

it('can access user create page', function (User $admin) {
    actingAs($admin)
        ->get(route('user.create'))
        ->assertSuccessful()
        ->assertSeeText('create page');
})->with('user_administrator');

/**
 * @group users store
 */
it('can\'t create user (unauthorized)', function () {
    post(route('user.store'))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t create user (user not admin)', function (User $user) {
    actingAs($user)
        ->post(route('user.store'))
        ->assertForbidden();
})->with('user');

it('can\'t create user (validation error)', function (User $admin) {
    actingAs($admin)
        ->post(route('user.store'))
        ->assertStatus(302)
        ->assertRedirect(route('user.create'))
        ->assertSessionHasErrors();
})->with('user_administrator');

it('can create user', function (User $admin) {
    $password = faker()->password(8);
    actingAs($admin)
    ->post(route('user.store'), [
        'name' => faker()->name,
        'email' => faker()->email,
        'username' => faker()->username,
        'email_verified_at' => now(),
        'image' => UploadedFile::fake()->image('users.jpg'),
        'password' => $password,
        'password_confirmation' => $password,
        'role_id' => faker()->randomElement(RoleEnum::values()),
    ])
    ->assertSessionDoesntHaveErrors();
})->with('user_administrator');

/**
 * @group users show page
 */
it('can\'t access user show page (unauthorized)', function () {
    get(route('user.show', -1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access user show page (user not admin)', function (User $user) {
    actingAs($user)
        ->get(route('user.show', $user))
        ->assertForbidden();
})->with('user');

it('can\'t access user show page (not found)', function (User $admin) {
    actingAs($admin)
        ->get(route('user.show', -1))
        ->assertNotFound();
})->with('user_administrator');

it('can access user show page', function (User $admin, User $user) {
    actingAs($admin)
        ->get(route('user.show', $user))
        ->assertSuccessful()
        ->assertSeeText('show page');
})->with('user_administrator', 'user');

/**
 * @group users edit page
 */
it('can\'t access user edit page (unauthorized)', function () {
    get(route('user.edit', -1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access user edit page (user not admin)', function (User $user) {
    actingAs($user)
        ->get(route('user.edit', $user))
        ->assertForbidden();
})->with('user');

it('can\'t access user edit page (not found)', function (User $admin) {
    actingAs($admin)
        ->get(route('user.edit', -1))
        ->assertNotFound();
})->with('user_administrator');

it('can access user edit page', function (User $admin, User $user) {
    actingAs($admin)
        ->get(route('user.edit', $user))
        ->assertSuccessful()
        ->assertSeeText('edit page');
})->with('user_administrator', 'user');

/**
 * @group users update
 */
it('can\'t update user (unauthorized)', function () {
    put(route('user.update', -1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t update user (user not admin)', function (User $user) {
    actingAs($user)
        ->put(route('user.update', $user))
        ->assertForbidden();
})->with('user');

it('can\'t update user (not found)', function (user $admin) {
    actingAs($admin)
        ->put(route('user.update', -1))
        ->assertNotFound();
})->with('user_administrator');

it('can\'t update user (validation error)', function (User $admin, User $user) {
    actingAs($admin)
        ->put(route('user.update', $user))
        ->assertStatus(302)
        ->assertRedirect(route('user.edit', $user))
        ->assertSessionHasErrors();
})->with('user_administrator', 'user');

it('can update user', function (User $admin, User $user) {
    $password = faker()->password(8);
    actingAs($admin)
    ->post(route('user.update', $user), [
        'name' => faker()->name,
        'email' => faker()->email,
        'username' => faker()->username,
        'email_verified_at' => now(),
        'image' => UploadedFile::fake()->image('users.jpg'),
        'password' => $password,
        'confirm_password' => $password,
        'role_id' => faker()->randomElement(RoleEnum::values()),
    ])
    ->assertSessionDoesntHaveErrors();
})->with('user_administrator', 'user');

/**
 * @group users destroy
 */
it('can\'t delete user (unauthorized)', function () {
    delete(route('user.destroy', -1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t delete user (user not admin)', function (User $user) {
    actingAs($user)
        ->delete(route('user.destroy', $user))
        ->assertForbidden();
})->with('user');

it('can\'t delete user (not found)', function (User $admin) {
    actingAs($admin)
        ->delete(route('user.destroy', -1))
        ->assertNotFound();
})->with('user_administrator');

it('can delete user', function (User $admin, User $user) {
    actingAs($admin)
        ->delete(route('user.destroy', $user))
        ->assertRedirect(route('user.index'))
        ->assertSessionDoesntHaveErrors();
})->with('user_administrator', 'user');
