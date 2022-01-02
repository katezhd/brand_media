<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable()->comment('Название страницы');
            $table->string('uri', 255)->nullable()->comment('Адрес страницы');
            $table->text('text')->nullable();
            $table->string('meta_title', 255)->nullable()->comment('Содержимое тега title');
            $table->string('meta_description', 255)->nullable()->comment('Содержимое тега meta name="description"');
            $table->timestamp('published_at')->nullable()->comment('Дата публикации');
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
        Schema::dropIfExists('pages');
    }
}
