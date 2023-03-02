<?php

use App\Models\User;
use function Pest\Faker\faker;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('can\'t access login page (already authorized)', function (User $user) {
    actingAs($user)
        ->get(route('login'))
        ->assertStatus(302)
        ->assertRedirect(route('index'));
})->with('user');

it('can access login page', function () {
    get(route('login'))
        ->assertStatus(200)
        ->assertSee('login page');
});

it('can\'t login (validation errors)', function () {
    post(route('login'))
        ->assertStatus(302)
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors();
});

it('can\'t login (wrong credentials)', function (User $admin) {
    post(route('login'), [
        'username' => $admin->email,
        'password' => faker()->password(8),
    ])->assertStatus(302)
        ->assertRedirect(route('login'))
        ->assertSessionHasErrors();
})->with('user_administrator');

it('can login', function () {
    config(['app.env' => 'production']);
    $user = User::factory()->create([
        'email' => faker()->email,
    ]);
    post(route('login'), [
        'username' => $user->email,
        'password' => 'password',
    ])->assertStatus(302)
        ->assertRedirect(route('index'))
        ->assertSessionHasNoErrors();
});
