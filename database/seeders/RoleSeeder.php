<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::trancate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('roles')->insert([
            ['name'=>'super-admin','guard_name' =>'api','description'=>'can do anything'],
            ['name'=> 'employ', 'guard_name' =>'api', 'description'=>'can adit and create products, add new brands and category,manage comments'],
            ['name' =>'author' , 'guard_name'=>'api' , 'description' =>'can create products , manege comments'],
        ]);
    }
}
