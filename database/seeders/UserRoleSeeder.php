<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'developer', 'client', 'community_manager', 'project_lead'];

        foreach ($roles as $roleName) {
            $user = User::firstOrCreate(
                ['email' => "{$roleName}@example.com"],
                [
                    'name' => ucfirst(str_replace('_', ' ', $roleName)),
                    'password' => Hash::make('password'),
                ]
            );
            $user->syncRoles($roleName);
        }
    }
}
