<?php

use App\Models\User;
use function Pest\Faker\faker;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('can\'t access forgot password page (already authorized)', function (User $user) {
    actingAs($user)
        ->get(route('forgot-password'))
        ->assertStatus(302)
        ->assertRedirect(route('index'));
})->with('user');

it('can access forgot password page', function () {
    get(route('forgot-password'))
        ->assertStatus(200)
        ->assertSeeText('Forgot Password');
});

it('can\'t send forgot password reset request (validation error)', function () {
    post(route('forgot-password'))
        ->assertStatus(302)
        ->assertRedirect(route('forgot-password'))
        ->assertSessionHasErrors();
});

it('can\'t send forgot password reset request (user not found)', function () {
    post(route('forgot-password'), [
        'email' => faker()->email,
    ])->assertStatus(302)
        ->assertRedirect(route('forgot-password'))
        ->assertSessionHasErrors();
});

it('can send forgot password reset request', function (User $user) {
    post(route('forgot-password'), [
        'email' => $user->email,
    ])->assertStatus(302)
        ->assertRedirect(route('forgot-password'))
        ->assertSessionHasNoErrors();
})->with('user');
