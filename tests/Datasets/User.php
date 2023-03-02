<?php

use App\Enums\RoleEnum;
use App\Models\User;

dataset('user', fn () => yield fn () => User::factory()->create());

dataset('user_administrator', fn () => yield fn () => User::factory()->create()->assignRole(RoleEnum::ADMINISTRATOR->value));

dataset('user_teacher', fn () => yield fn () => User::factory()->create()->assignRole(RoleEnum::TEACHER->value));

dataset('user_student', fn () => yield fn () => User::factory()->create()->assignRole(RoleEnum::STUDENT->value));
