<?php

use App\Models\User;
use function Pest\Faker\faker;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertTrue;

it('can show the reset password page', function () {
    get(route('password.reset', [
        'token' => faker()->uuid,
        'email' => faker()->email,
    ]))->assertStatus(200)
        ->assertSeeText('Reset Password');
});

it('can\'t reset password (validation error)', function () {
    $token = faker()->uuid;
    $email = faker()->email;
    post(route('password.reset', [
        'token' => $token,
        'email' => $email,
    ]))->assertStatus(302)
        ->assertRedirect(route('password.reset', [
            'token' => $token,
            'email' => $email,
        ]))->assertSessionHasErrors();
});

it('can\'t reset password (invalid token)', function () {
    $user = User::factory()->create();
    Password::broker()->createToken($user);
    $token = faker()->uuid;
    post(route('password.reset', [
        'token' => $token,
        'email' => $user->email,
    ]), [
        'token' => $token,
        'email' => $user->email,
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ])
        ->assertStatus(302)
        ->assertRedirect(route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ]))
        ->assertSessionHasErrors();
});

it('can reset password', function () {
    $user = User::factory()->create();
    $token = Password::broker()->createToken($user);
    post(route('password.reset', [
        'token' => $token,
        'email' => $user->email,
    ]), [
        'token' => $token,
        'email' => $user->email,
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ])->assertStatus(302)
        ->assertRedirect(route('login'))
        ->assertSessionHasNoErrors();

    assertTrue(Auth::attempt([
        'email' => $user->email,
        'password' => 'new-password',
    ]));
});
