<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $superAdmin = Role::create(
            ['name' => 'super-admin', 'guard_name' => 'api', 'description' => 'can do anything']);
        $employ = Role::create(
            ['name' => 'employ', 'guard_name' => 'api', 'description' => 'can adit and create products, add new brands and category,manage comments']);
        $author = Role::create(
            ['name' => 'author', 'guard_name' => 'api', 'description' => 'can create products , manege comments']);
        $allPermission = Permission::pluck('name')->toArray();

        $superAdmin->givePermissionTo($allPermission);
        $employPermissions = [
            'product-list', 'product-create', 'product-edit',
            'order-list', 'order-create', 'order-edit',
            'gift-list', 'gift-create', 'gift-edit',
            'see-dashboard',
        ];
        $employ->givePermissionTo($employPermissions);
        $authorPermission = [
            'product-list', 'product-create',
            'see-dashboard',
        ];
        $author->givePermissionTo($authorPermission);
    }

}
