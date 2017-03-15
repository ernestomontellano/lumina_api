<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotografosTable extends Migration
{

    public function up()
    {
        Schema::create('fotografos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 250);
            $table->text('biografia');
            $table->text('imagen');
            $table->bigInteger('soportes_id')->unsigned();
            $table->foreign('soportes_id')->references('id')->on('soportes')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::drop('fotografos');
    }

}
