<?php

namespace Modules\User\Database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        $employ = User::create([
            'name' => 'Employ',
            'email' => 'employ@jsonapi.com',
            'password' =>'123456789',
        ]);
        $super_admin = User::create([
            'name' => 'Super-Admin',
            'email' => 'superAdmin@jsonapi.com',
            'password' => '123456789',
        ]);
        $author = User::create([
            'name' => 'Author',
            'email' => 'author@jsonapi.com',
            'password' => '123456789',
        ]);

        $super_admin->assignRole(Role::findByName('super-admin' , 'api'));
        $employ->assignRole(Role::findByName('employ' , 'api'));
        $author->assignRole(Role::findByName('author' , 'api'));
        User::factory(10)->create();
    }
}
