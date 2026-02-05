<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'developer']);
        Role::firstOrCreate(['name' => 'client']);
        Role::firstOrCreate(['name' => 'community_manager']);
        Role::firstOrCreate(['name' => 'project_manager']);
    }
}
