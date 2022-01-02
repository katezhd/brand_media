<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsetHoroscopesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inset_horoscopes', function (Blueprint $table) {
            $table->id();
            $table->text('text')->nullable();
            $table->bigInteger('sign_id')->nullable()->unsigned()->comment('ID знака зодиака из таблицы inset_horoscope_signs');
            $table->foreign('sign_id')->references('id')->on('inset_horoscope_signs');
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
        Schema::dropIfExists('inset_horoscopes');
    }
}
