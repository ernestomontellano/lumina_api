<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesetiquetasTable extends Migration
{

    public function up()
    {
        Schema::create('imagenesetiquetas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('imagenes_id')->unsigned();
            $table->foreign('imagenes_id')->references('id')->on('imagenes')->onDelete('cascade');
            $table->foreign('etiquetas_id')->unsigned();
            $table->foreign('etiquetas_id')->references('id')->on('etiquetas')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::drop('imagenesetiquetas');
    }

}
