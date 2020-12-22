<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFlVisivelPalestrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('palestrantes', function (Blueprint $table) {
            $table->integer('fl_visivel')->default(1)->after('lk_thumb');
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
            $table->dropColumn('fl_visivel');
        });
    }
}
