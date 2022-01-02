<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            'plural'   => 'users_group',
            'singular' => NULL,
            'name'     => 'Пользователи',
            'icon'     => 'icon-User', 
            'sort'     => 1,
            'default_order' => NULL
        ]);
        DB::table('modules')->insert([
            'parent_id' => 1,
            'plural'    => 'users',
            'singular'  => 'user',
            'name'      => 'Пользователи',
            'sort'      => 1
        ]);
        DB::table('modules')->insert([
            'parent_id' => 1,
            'plural'    => 'roles',
            'singular'  => 'role',
            'name'      => 'Роли пользователей', 
            'sort'      => 2,
            'default_order' => 'name|asc'
        ]);
        DB::table('modules')->insert([
            'plural'    => 'authors',
            'singular'  => 'author',
            'name'      => 'Авторы', 
            'icon'      => 'icon-Fountain-Pen',
            'sort'      => 2,
            'default_order' => 'id|desc'
        ]);
        DB::table('modules')->insert([
            'plural'    => 'categories',
            'singular'  => 'category',
            'name'      => 'Категории', 
            'icon'      => 'icon-Bulleted-List',
            'sort'      => 3,
            'default_order' => 'id|desc'
        ]);
        DB::table('modules')->insert([
            'plural'    => 'tags',
            'singular'  => 'tag',
            'name'      => 'Теги', 
            'icon'      => 'icon-Tag',
            'sort'      => 4,
            'default_order' => 'id|desc'
        ]);
        DB::table('modules')->insert([
            'plural'    => 'news',
            'singular'  => 'news',
            'name'      => 'Новости', 
            'icon'      => 'icon-Newspaper',
            'sort'      => 5,
            'default_order' => 'id|desc'
        ]);
    }
}
