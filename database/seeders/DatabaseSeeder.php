<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // Create admin user
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@schoolportal.com',
            'role_id' => $adminRole->id,
            'employee_id' => 'ADM001',
        ]);
    }
}
