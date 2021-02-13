<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoCorporativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos_corporativos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('S_Nombre', 45);
            $table->string('S_Puesto', 45);
            $table->string('S_Comentarios', 255)->nullable();
            $table->string('N_TelefonoFijo', 12)->nullable();
            $table->string('N_TelefonoMovil', 12)->nullable();
            $table->string('S_Email', 45);
            $table->integer('corporativos_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos_corporativos');
    }
}
