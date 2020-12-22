<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('id_evento', 36)->index();
            $table->string('nm_sala');
            $table->string('slug_sala');
            $table->string('thumb_sala');
            $table->string('lk_sala');
            $table->longText('descricao');
            $table->dateTime('dt_inicio', 0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salas');
    }
}
