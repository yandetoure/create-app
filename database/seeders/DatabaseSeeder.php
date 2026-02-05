<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Demo Client',
            'email' => 'client@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            // 'is_admin' => true, // I will add this column later if needed, for now let's assume roles
        ]);

        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            FeatureSeeder::class,
        ]);

        User::where('email', 'admin@example.com')->first()?->assignRole('developer');
        User::where('email', 'client@example.com')->first()?->assignRole('client');
    }
}
