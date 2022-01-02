<?php

use Database\Seeders\RoleModuleSeeder2;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScopesToRolesModulesRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles_modules_rel', function (Blueprint $table) {
            $table->string('scopes', 255)->nullable()->after('module_id')->comment('JSON объект с правами');
        });

        $seeder = new RoleModuleSeeder2();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles_modules_rel', function (Blueprint $table) {
            $table->dropColumn('scopes');
        });
    }
}
