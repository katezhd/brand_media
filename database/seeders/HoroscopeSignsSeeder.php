<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoroscopeSignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Овен',
            'slug'  => 'aries'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Телец',
            'slug'  => 'taurus'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Близнецы',
            'slug'  => 'gemini'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Рак',
            'slug'  => 'cancer'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Лев',
            'slug'  => 'leo'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Дева',
            'slug'  => 'virgo'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Весы',
            'slug'  => 'libra'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Скорпион',
            'slug'  => 'scorpio'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Стрелец',
            'slug'  => 'sagittarius'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Козерог',
            'slug'  => 'capricorn'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Водолей',
            'slug'  => 'aquarius'
        ]);
        DB::table('inset_horoscope_signs')->insert([
            'name'      => 'Рыбы',
            'slug'  => 'pisces'
        ]);
    }
}
