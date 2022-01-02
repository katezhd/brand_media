<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeatherCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inset_weather_cities')->insert([
            'name' => 'Кривий Ріг'
        ]);
        DB::table('inset_weather_cities')->insert([
            'name' => 'Покровськ'
        ]);
        DB::table('inset_weather_cities')->insert([
            'name' => 'Маріуполь'
        ]);
        DB::table('inset_weather_cities')->insert([
            'name' => 'Макіївка'
        ]);
        DB::table('inset_weather_cities')->insert([
            'name' => 'Запоріжжя'
        ]);
        DB::table('inset_weather_cities')->insert([
            'name' => 'Авдіївка'
        ]);
    }
}
