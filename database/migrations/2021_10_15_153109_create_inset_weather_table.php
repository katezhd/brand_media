<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsetWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inset_weather', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('temp');
            $table->bigInteger('city_id')->nullable()->unsigned()->comment('ID города из таблицы inset_weather_cities');
            $table->foreign('city_id')->references('id')->on('inset_weather_cities');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inset_weather');
    }
}
