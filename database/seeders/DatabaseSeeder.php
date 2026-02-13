<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Database\seeders\CreateAdminUserSeeder;
use Modules\User\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123456789',
        ]);
        $this->call([
           PermissionTableSeeder::class,
           RoleSeeder::class,
            CreateAdminUserSeeder::class,
        ]);
    }
}
