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

        $this->call([
            PermissionTableSeeder::class,
            RoleSeeder::class,
            CreateAdminUserSeeder::class,
        ]);
    }
}
