<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'order-list',
            'order-create',
            'order-edit',
            'order-delete',

            'gift-list',
            'gift-create',
            'gift-edit',
            'gift-delete',

            'see-dashboard',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission , 'guard_name' => 'api']);

        }
    }
}
