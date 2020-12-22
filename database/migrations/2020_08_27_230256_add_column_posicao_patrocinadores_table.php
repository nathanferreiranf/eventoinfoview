<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPosicaoPatrocinadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patrocinadores', function (Blueprint $table) {
            $table->integer('posicao')->default(0)->after('fl_visivel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patrocinadores', function (Blueprint $table) {
            $table->dropColumn('posicao');
        });
    }
}
