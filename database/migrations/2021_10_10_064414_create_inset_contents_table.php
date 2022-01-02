<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsetContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inset_contents', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['quote', 'joke', 'horoscope', 'video', 'weather', 'currency']);
            $table->string('name', 255)->nullable();
            $table->text('text')->nullable();
            $table->string('image', 25)->nullable();
            $table->string('video_code', 25)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inset_contents');
    }
}
