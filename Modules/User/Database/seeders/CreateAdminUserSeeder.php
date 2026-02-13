<?php

namespace Modules\User\Database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\User;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@jsonapi.com',
            'password' => '123456789',
        ]);
        $user->assignRole('super-admin');
    }
}
