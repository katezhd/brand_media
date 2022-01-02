<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('position')->comment('Порядковый номер блока');
            $table->enum('type', ['categories', 'videos', 'custom'])->default('videos');
            $table->text('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('published_at')->nullable()->comment('Дата публикации');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insets');
    }
}
