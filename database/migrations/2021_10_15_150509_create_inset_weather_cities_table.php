<?php
use Database\Seeders\WeatherCitiesSeeder;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsetWeatherCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inset_weather_cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
        });

        $seeder = new WeatherCitiesSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inset_weather_cities');
    }
}
