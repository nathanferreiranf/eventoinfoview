<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsLinksSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salas', function (Blueprint $table) {
            $table->text('lk_sala')->change();
            $table->text('lk_perguntas')->change();
            $table->text('lk_chat')->change();
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
            $table->string('lk_sala')->change();
            $table->string('lk_perguntas')->change();
            $table->string('lk_chat')->change();
        });
    }
}
