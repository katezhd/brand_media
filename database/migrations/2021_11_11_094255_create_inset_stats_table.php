<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsetStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inset_stats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inset_id')->unsigned()->comment('ID перебивки из таблицы inset_contents')->nullable();
            $table->foreign('inset_id')->references('id')->on('inset_contents');
            $table->string('type', 255)->nullable();
            $table->string('social', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inset_stats');
    }
}
