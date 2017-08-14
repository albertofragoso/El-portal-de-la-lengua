<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modificaciones', function(Blueprint $table) {
          $table->increments('id');
          $table->timestamps();

          $table->integer('articulo_id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->string('titulo');
          $table->text('contenido');
          $table->string('imagen');
          $table->string('descripcion');

          $table->foreign('articulo_id')->references('id')->on('articulos');
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
        Schema::dropIfExists('modificaciones');
    }
}
