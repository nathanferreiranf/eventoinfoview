<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPosicaoPalestrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('palestrantes', function (Blueprint $table) {
            $table->integer('posicao')->default(0)->after('fl_principal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('palestrantes', function (Blueprint $table) {
            $table->dropColumn('posicao');
        });
    }
}
