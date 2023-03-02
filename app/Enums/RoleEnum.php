<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum RoleEnum: string
{
    use EnumToArray;

    case ADMINISTRATOR = 'Administrator';
    case TEACHER = 'Teacher';
    case STUDENT = 'Student';
}
