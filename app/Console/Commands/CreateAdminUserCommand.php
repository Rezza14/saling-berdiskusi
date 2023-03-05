<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Command\Command as CommandAlias;
use Throwable;

class CreateAdminUserCommand extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Create a admin user';

    /**
     * @throws Throwable
     */
    public function handle(): int
    {
        name:
        $name = $this->ask('What is the name of the admin?');
        if (empty($name)) {
            $this->error('Name is required');
            goto name;
        }

        email:
        $email = $this->ask('What is the email of the admin?');
        if (empty($email)) {
            $this->error('Email is required');
            goto email;
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Email is invalid');
            goto email;
        }

        username:
        $username = $this->ask('What is the username of the admin?');
        if (empty($username)) {
            $this->error('Username is required');
            goto username;
        }

        password:
        $password = $this->secret('What is the password of the admin?');
        if (empty($password)) {
            $this->error('Password is required');
            goto password;
        }
        if (strlen($password) < 8) {
            $this->error('Password is too short. It must be at least 8 characters');
            goto password;
        }

        $this->info('Creating a admin user with the following credentials:');
        $this->info("Name: $name");
        $this->info("Username: $username");
        $this->info("Email: $email");

        if ($this->confirm('Do you wish to create the user?')) {
            $this->info('Creating the user...');
            DB::beginTransaction();
            try {
                $user = User::create([
                    'name' => $name,
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);
                $user->assignRole(RoleEnum::ADMINISTRATOR->value);
                DB::commit();
                $this->info('Admin user created successfully.');

                return CommandAlias::SUCCESS;
            } catch (Exception $e) {
                DB::rollBack();
                $this->error('Could not create the user.');
                $this->error($e->getMessage());

                return CommandAlias::FAILURE;
            }
        } else {
            $this->error('Command Cancelled!');

            return CommandAlias::INVALID;
        }
    }
}
