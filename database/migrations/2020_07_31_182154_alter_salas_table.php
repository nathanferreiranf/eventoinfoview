<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->string('lk_sala')->nullable()->change();
            $table->string('lk_chat')->nullable()->change();
            $table->string('lk_perguntas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->string('lk_sala')->nullable(false)->change();
            $table->string('lk_chat')->nullable(false)->change();
            $table->string('lk_perguntas')->nullable(false)->change();
        });
    }
}
