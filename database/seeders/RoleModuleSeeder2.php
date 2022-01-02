<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleModuleSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        DB::table('roles_modules_rel')->insert([
            'role_id' => 1, 
            'module_id' => 1, 
            'scopes' => '{"read":"1","create":"1","update":"1","delete":"1","publish":"0"}', 
            'created_at' => $now, 
            'updated_at' => $now
        ]);
        DB::table('roles_modules_rel')->insert([
            'role_id' => 1, 
            'module_id' => 2, 
            'scopes' => '{"read":"1","create":"1","update":"1","delete":"1","publish":"0"}', 
            'created_at' => $now, 
            'updated_at' => $now
        ]);
        DB::table('roles_modules_rel')->insert([
            'role_id' => 1, 
            'module_id' => 3, 
            'scopes' => '{"read":"1","create":"1","update":"1","delete":"1","publish":"0"}', 
            'created_at' => $now, 
            'updated_at' => $now
        ]);
        DB::table('roles_modules_rel')->insert([
            'role_id' => 1, 
            'module_id' => 4, 
            'scopes' => '{"read":"1","create":"1","update":"1","delete":"1","publish":"0"}', 
            'created_at' => $now, 
            'updated_at' => $now
        ]);
        DB::table('roles_modules_rel')->insert([
            'role_id' => 1, 
            'module_id' => 5, 
            'scopes' => '{"read":"1","create":"1","update":"1","delete":"1","publish":"1"}', 
            'created_at' => $now, 
            'updated_at' => $now
        ]);
        DB::table('roles_modules_rel')->insert([
            'role_id' => 1, 
            'module_id' => 6, 
            'scopes' => '{"read":"1","create":"1","update":"1","delete":"1","publish":"1"}', 
            'created_at' => $now, 
            'updated_at' => $now
        ]);
        DB::table('roles_modules_rel')->insert([
            'role_id' => 1, 
            'module_id' => 7, 
            'scopes' => '{"read":"1","create":"1","update":"1","delete":"1","publish":"1"}', 
            'created_at' => $now, 
            'updated_at' => $now
        ]);
    }
}
