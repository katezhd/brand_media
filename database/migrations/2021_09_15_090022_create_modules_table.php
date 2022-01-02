<?php
use Database\Seeders\ModuleSeeder;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable()->unsigned()->comment('ID модуля из таблицы modules');
            $table->foreign('parent_id')->references('id')->on('modules')->constrained()->onDelete('cascade');
            $table->string('plural', 50)->nullable();
            $table->string('singular', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('icon', 50)->nullable();
            $table->smallInteger('sort')->default(0);
            $table->string('default_order', 50)->nullable()->default('id|desc')->comment('сортировка в списке по-умолчанию');
        });

        $seeder = new ModuleSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('modules');
        Schema::enableForeignKeyConstraints();
    }
}
