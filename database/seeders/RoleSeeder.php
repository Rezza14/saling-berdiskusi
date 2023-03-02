<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        foreach (RoleEnum::cases() as $role) {
            Role::firstOrCreate(['name' => $role->value]);
        }
    }
}
