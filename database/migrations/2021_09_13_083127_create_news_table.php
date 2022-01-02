<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('uri', 255)->nullable()->unique();
            $table->text('text')->nullable();
            $table->string('image', 25)->nullable();
            $table->string('image_alt', 255)->nullable();
            $table->bigInteger('category_id')->nullable()->unsigned()->comment('ID категории из таблицы categories');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamp('published_at')->nullable()->comment('Дата публикации');
            $table->bigInteger('published_by')->nullable()->unsigned()->comment('ID пользователя из таблицы users');
            $table->foreign('published_by')->references('id')->on('users');
            $table->timestamps();
            $table->bigInteger('updated_by')->nullable()->unsigned()->comment('ID пользователя из таблицы users');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('news');
    }
}
