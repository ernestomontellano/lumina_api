<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenesTable extends Migration
{

    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 250);
            $table->string('codigo', 20);
            $table->text('imagen');
            $table->text('descripcion');
            $table->bigInteger('soportes_id')->unsigned();
            $table->foreign('soportes_id')->references('id')->on('soportes')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::drop('imagenes');
    }

}