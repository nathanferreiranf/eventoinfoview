<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFlObrigatorioEventosCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos_campos', function (Blueprint $table) {
            $table->integer('fl_obrigatorio')->default(0)->after('slug_campo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventos_campos', function (Blueprint $table) {
            $table->dropColumn('fl_obrigatorio');
        });
    }
}
