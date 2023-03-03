<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use function Pest\Faker\faker;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\put;

/*
 * @group access profil page
 */
it('can\'t access profile page (unauthorize)', function () {
    get(route('profile.index'))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access profile page (invalid user role)', function (User $user) {
    actingAs($user)
        ->get(route('profile.index'))
        ->assertForbidden();
})->with('user');

it('can access profile page', function (User $admin) {
    actingAs($admin)
        ->get(route('profile.index'))
        ->assertOk();
})->with('user_administrator');

/*
 * @group update profile
 */
it('can\'t update profile (unauthorize)', function () {
    put(route('profile.update', -1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t update profile (invalid user role)', function (User $user) {
    actingAs($user)
        ->get(route('profile.update', -1))
        ->assertForbidden();
})->with('user');

it('can\'t update profile (validation error)', function (User $admin) {
    actingAs($admin)
        ->put(route('profile.update', $admin), [])
        ->assertStatus(302)
        ->assertSessionHasErrors();
})->with('user_administrator');

it('can update profile', function (User $admin) {
    actingAs($admin)
        ->put(route('profile.update', $admin), [
            'name' => faker()->name,
            'username' => faker()->name,
            'email' => faker()->email,
        ])
        ->assertSessionDoesntHaveErrors();
})->with('user_administrator');

/*
 * @group update profile image
 */
it('can\'t update profile photo (unauthorize)', function () {
    put(route('profile.updateAvatar', -1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t update profile photo (validation error)', function (User $admin) {
    actingAs($admin)
        ->put(route('profile.updateAvatar', $admin))
        ->assertStatus(302)
        ->assertSessionHasErrors();
})->with('user_administrator');

it('can update profile photo', function (User $admin) {
    actingAs($admin)
        ->put(route('profile.updateAvatar', $admin), [
            'image' => UploadedFile::fake()->image('user.jpg'),
        ])
        ->assertSessionDoesntHaveErrors();
})->with('user_administrator');

/*
 * @group update password
 */
it('can\'t update password (unauthorized)', function () {
    put(route('profile.updatePassword', -1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t update profile password (validation error)', function (User $admin) {
    actingAs($admin)
        ->put(route('profile.updatePassword', $admin))
        ->assertStatus(302)
        ->assertSessionHasErrors();
})->with('user_administrator');

it('can update password', function (User $admin) {
    actingAs($admin)
        ->put(route('profile.updatePassword', $admin), [
            'old_password' => 'password',
            'new_password' => '$2y$10$ER/41YsBRK/S9D4/NylLR',
            'new_password_confirmation' => '$2y$10$ER/41YsBRK/S9D4/NylLR',
        ])
        ->assertSessionDoesntHaveErrors();
})->with('user_administrator');
