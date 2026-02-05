<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admins
            ['email' => 'admin@example.com', 'name' => 'Super Admin', 'role' => 'admin'],
            ['email' => 'yande@example.com', 'name' => 'Yande Toure', 'role' => 'admin'],

            // Developers
            ['email' => 'developer@example.com', 'name' => 'Lead Developer', 'role' => 'developer'],
            ['email' => 'dev1@example.com', 'name' => 'Junior Dev 1', 'role' => 'developer'],
            ['email' => 'dev2@example.com', 'name' => 'Junior Dev 2', 'role' => 'developer'],

            // Clients
            ['email' => 'client@example.com', 'name' => 'Demo Client', 'role' => 'client'],
            ['email' => 'customer@example.com', 'name' => 'Private Customer', 'role' => 'client'],

            // Community Managers
            ['email' => 'cm@example.com', 'name' => 'CM Social', 'role' => 'community_manager'],

            // Project Leads
            ['email' => 'lead@example.com', 'name' => 'Project Manager', 'role' => 'project_lead'],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                ]
            );
            $user->syncRoles($userData['role']);
        }
    }
}
