<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenestamanhosTable extends Migration
{

    public function up()
    {
        Schema::create('imagenestamanhos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('imagenes_id')->unsigned();
            $table->foreign('imagenes_id')->references('id')->on('imagenes')->onDelete('cascade');
            $table->bigInteger('tamanhos_id')->unsigned();
            $table->foreign('tamanhos_id')->references('id')->on('tamanhos')->onUpdate('cascade');
            $table->string('preciobs', 10);
            $table->string('preciosus', 10);
            $table->integer('disponible')->default(0);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::drop('imagenestamanhos');
    }

}
