<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFlPrincipalPalestrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('palestrantes', function (Blueprint $table) {
            $table->integer('fl_principal')->default(0)->after('fl_visivel');
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
            $table->dropColumn('fl_principal');
        });
    }
}
