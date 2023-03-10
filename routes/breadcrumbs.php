<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::macro('resource', function (string $name, string $title) {
    Breadcrumbs::for("$name.index", function (BreadcrumbTrail $trail) use ($name, $title) {
        $trail->parent('index');
        $trail->push($title, route("$name.index"));
    });

    Breadcrumbs::for("$name.create", function (BreadcrumbTrail $trail) use ($name) {
        if ($name != "discussions") {
            $trail->parent("$name.index");
        } else {
            $trail->parent("index");
        }
        $trail->push('New', route("$name.create"));
    });

    Breadcrumbs::for("$name.show", function (BreadcrumbTrail $trail, mixed $model) use ($name) {
        if ($name != "discussions" && Auth::user() != null && Auth::user()->getRoleNames()->implode('') == 'Administrator') {
            $trail->parent("$name.index");
        } else {
            $trail->parent("index");
        }
        $trail->push($model->getRouteKey() ?? 'Detail', route("$name.show", $model));
    });

    Breadcrumbs::for("$name.edit", function (BreadcrumbTrail $trail, mixed $model) use ($name) {
        $trail->parent("$name.show", $model);
        $trail->push('Edit', route("$name.edit", $model));
    });

    Breadcrumbs::for("$name.trashed", function (BreadcrumbTrail $trail) use ($name) {
        $trail->parent("$name.index");
        $trail->push('Deleted', route("$name.index"));
    });
});

Breadcrumbs::for('index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('index'));
});
Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent("index");
    $trail->push('Login', route('login'));
});
Breadcrumbs::for('forgot-password', function (BreadcrumbTrail $trail) {
    $trail->parent("login");
    $trail->push('Forgot Password', route('forgot-password'));
});
Breadcrumbs::for('password.reset', function (BreadcrumbTrail $trail, mixed $model) {
    $trail->parent("forgot-password");
    $trail->push('Reset Password', route('password.reset', $model));
});
Breadcrumbs::for('comments.edit', function (BreadcrumbTrail $trail, mixed $model) {
    $trail->parent("discussions.show", $model->discussion);
    $trail->push('Comment Edit', route('comments.edit', $model));
});

Breadcrumbs::resource('user', 'User');
Breadcrumbs::resource('page', 'Page');
Breadcrumbs::resource('discussions', 'Discussions');
Breadcrumbs::resource('profile', 'Profile');
