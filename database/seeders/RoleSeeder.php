<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'    => 'Суперадмин',
            'scopes'  => '{"read":"1","create":"1","update":"1","delete":"1","publish":"1"}'
        ]);
        DB::table('roles')->insert([
            'name'    => 'Редактор',
            'scopes'  => '{"read":"1","create":"1","update":"1","delete":"1","publish":"1"}'
        ]);
        DB::table('roles')->insert([
            'name'    => 'Журналист',
            'scopes'  => '{"read":"1","create":"1","update":"1","delete":"0","publish":"0"}'
        ]);
    }
}
