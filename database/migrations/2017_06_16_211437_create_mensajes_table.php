<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mensajes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('conversacion_id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->string('contenido');
          $table->timestamps();

          $table->foreign('conversacion_id')->references('id')->on('conversaciones');
          $table->foreign('user_id')->references('id')->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajes');
    }
}
