<?php

use App\Models\Page;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

/**
 * @group page index page
 */
it('can\'t access pages page (unauthorize)', function () {
    get(route('page.index'))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access pages page (user not admin)', function (User $user) {
    actingAs($user)
        ->get(route('page.index'))
        ->assertForbidden();
})->with('user');

it('can access pages page', function (User $admin) {
    actingAs($admin)
        ->get(route('page.index'))
        ->assertSeeText('index page')
        ->assertSuccessful();
})->with('user_administrator');

/**
 * @group pages create page
 */
it('can\'t access pages create page (unauthorized)', function () {
    get(route('page.create'))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access pages create page (user not admin)', function (User $user) {
    actingAs($user)
        ->get(route('page.create'))
        ->assertForbidden();
})->with('user');

it('can access pages create page', function (User $admin) {
    actingAs($admin)
        ->get(route('page.create'))
        ->assertSeeText('create page')
        ->assertSuccessful();
})->with('user_administrator');

/**
 * @group pages store
 */
it('can\'t create page (unauthorized)', function () {
    post(route('page.store'))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t create page (user not admin)', function (User $user) {
    actingAs($user)
        ->get(route('page.store'))
        ->assertForbidden();
})->with('user');

it('can\'t create page (validation error)', function (User $admin) {
    actingAs($admin)
        ->post(route('page.store'), [])
        ->assertStatus(302)
        ->assertRedirect(route('page.create'))
        ->assertSessionHasErrors();
})->with('user_administrator');

it('can create page', function (User $admin) {
    $data = Page::factory()->make()->toArray();
    $data['page-trixFields'] = [
        'content' => fake()->paragraph,
    ];
    actingAs($admin)
        ->post(route('page.store'), $data)
        ->assertSessionDoesntHaveErrors();
})->with('user_administrator');

/**
 * @group Pages show page
 */
it('can\'t access pages detail page (unauthorized)', function () {
    get(route('page.show', 1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access pages detail page (user not admin)', function (User $user, Page $page) {
    actingAs($user)
        ->get(route('page.show', $page))
        ->assertForbidden();
})->with('user', 'page');

it('can\'t access pages detail page (not found)', function (User $admin) {
    actingAs($admin)
        ->get(route('page.show', -1))
        ->assertNotFound();
})->with('user_administrator');

it('can access pages detail page', function (User $admin, Page $page) {
    actingAs($admin)
        ->get(route('page.show', $page))
        ->assertSeeText('show page')
        ->assertSuccessful();
})->with('user_administrator', 'page');

/**
 * @group pages edit page
 */
it('can\'t access pages edit page (unauthorized)', function () {
    get(route('page.edit', 1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t access pages edit page (user not admin)', function (User $user, Page $page) {
    actingAs($user)
        ->get(route('page.edit', $page))
        ->assertForbidden();
})->with('user', 'page');

it('can\'t access pages edit page (not found)', function (User $admin) {
    actingAs($admin)
        ->get(route('page.edit', -1))
        ->assertNotFound();
})->with('user_administrator');

it('can access pages edit page', function (User $admin, Page $page) {
    actingAs($admin)
        ->get(route('page.edit', $page))
        ->assertSuccessful()
        ->assertSeeText('edit page');
})->with('user_administrator', 'page');

/**
 * @group pages update
 */
it('can\'t update page (unauthorized)', function () {
    put(route('page.update', 1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t update page (user not admin)', function (User $user, Page $page) {
    actingAs($user)
        ->get(route('page.update', $page))
        ->assertForbidden();
})->with('user', 'page');

it('can\'t update page (not found)', function (User $admin) {
    actingAs($admin)
        ->put(route('page.update', -1))
        ->assertNotFound();
})->with('user_administrator');

it('can\'t update pages (validation error)', function (User $admin, Page $page) {
    actingAs($admin)
        ->put(route('page.update', $page))
        ->assertStatus(302)
        ->assertRedirect(route('page.edit', $page))
        ->assertSessionHasErrors();
})->with('user_administrator', 'page');

it('can update Page', function (User $admin, Page $page) {
    $data = Page::factory()->make()->toArray();
    $data['page-trixFields'] = [
        'content' => fake()->paragraph,
    ];
    actingAs($admin)
        ->put(route('page.update', $page), $data)
        ->assertSessionDoesntHaveErrors();
})->with('user_administrator', 'page');

/**
 * @group pages destroy
 */
it('can\'t deleted page (unauthorized)', function () {
    delete(route('page.destroy', 1))
        ->assertStatus(302)
        ->assertRedirect(route('login'));
});

it('can\'t deleted page (user not admin)', function (User $user, Page $page) {
    actingAs($user)
        ->get(route('page.destroy', $page))
        ->assertForbidden();
})->with('user', 'page');

it('can\'t delete page (not found)', function (User $admin) {
    actingAs($admin)
        ->delete(route('page.destroy', -1))
        ->assertNotFound();
})->with('user_administrator');

it('can delete page', function (User $admin, Page $page) {
    actingAs($admin)
        ->delete(route('page.destroy', $page))
        ->assertRedirect(route('page.index'))
        ->assertSessionDoesntHaveErrors();
})->with('user_administrator', 'page');
