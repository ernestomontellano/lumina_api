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
            $table->text('email');
            $table->text('telefono');
            $table->text('biografia');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::drop('fotografos');
    }

}
