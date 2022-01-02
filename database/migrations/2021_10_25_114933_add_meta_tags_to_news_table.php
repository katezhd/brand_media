<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetaTagsToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('image_alt');

            $table->string('meta_title', 255)->nullable()->after('category_id');
            $table->string('meta_description', 255)->nullable()->after('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('image_alt', 255)->nullable()->after('image');

            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
        });
    }
}
