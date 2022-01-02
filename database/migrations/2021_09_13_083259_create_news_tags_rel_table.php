<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTagsRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_tags_rel', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('news_id')->nullable()->unsigned()->comment('ID новости из таблицы news');
            $table->bigInteger('tag_id')->nullable()->unsigned()->comment('ID тега из таблицы news_tags');
            $table->foreign('news_id')->references('id')->on('news')->constrained()->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_tags_rel');
    }
}
